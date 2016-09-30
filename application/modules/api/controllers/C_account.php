<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_account extends API_Controller {
    /*
     * Access Control List
     * 1    - createAccount
     * 2    - retrieveAccount
     * 4    - updateAccount
     * 8    - deleteAccount
     * 64   - admin
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("m_account");
        $this->load->model("M_account_information");
        $this->APICONTROLLERID = 1;
    }
    public function testEn(){
        $enctoken = generateToken(1, 2);
        print_r($enctoken);
        $dectoken = decodeToken($enctoken);
        print_r($dectoken);
    }
    public function createAccount(){
        $this->accessNumber = 1;
        //registration
        if(!$this->validReCaptcha() && $this->input->post("account_type_ID") == 3){//registraton required captcha to proceed
            $this->responseError(5, "Invalid Captcha");
            $this->outputResponse();
        }
        if(!$this->checkACL(64) && ($this->input->post("account_type_ID") != 3 || $this->input->post("status") != 2)){//
            $this->responseError(4, "Not authorized");
            $this->outputResponse();
        }
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|callback_is_unique_username');
//        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('account_type_ID', 'Account Type', 'required');
        
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|callback_alpha_dash_space');
        ($this->input->post("middle_name")) ? $this->form_validation->set_rules('middle_name', 'Middle Name', 'trim|callback_alpha_dash_space') : null;
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|callback_alpha_dash_space');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if($this->form_validation->run()){
            $result = $this->m_account->createAccount(
                    $this->input->post("username"),//$this->input->post("username"),
                    $this->input->post("first_name").$this->input->post("last_name"),//$this->input->post("password"),
                    $this->input->post("account_type_ID"),
                    2//$this->input->post("status")
                    );
            if($result){
                
                $this->M_account_information->createAccountInformation(
                        $result,
                        $this->input->post("first_name"),
                        $this->input->post("middle_name"),
                        $this->input->post("last_name"),
                        $this->input->post("email_address"),
                        $this->input->post("address"),
                        $this->input->post("birth_datetime"),
                        $this->input->post("nationality"),
                        $this->input->post("profession")
                        );
                if($this->input->post("new_educational_background")){
                    $this->load->model("M_educational_background");
                    $educationalBackground = $this->input->post("new_educational_background");
                    foreach($educationalBackground as $educationBackgroundValue){
                        $this->M_educational_background->createEducationalBackground($result, $educationBackgroundValue["degree"], $educationBackgroundValue["school"], $educationBackgroundValue["academic_year"]);
                    }
                }
                if($this->input->post("new_personal_interest")){
                    $this->load->model("M_personal_interest");
                    $personalInterest = $this->input->post("new_personal_interest");
                    foreach($personalInterest as $personalInterestValue){
                        $this->M_personal_interest->createPersonalInterest($result, $personalInterestValue["description"]);
                    }
                }
                $activationKey = base64_encode(time().$result);
                $emailResponse = $this->sendEmail("GRACE Academy Account Activation", $this->input->post("email_address"), "Good day! Your account for mygraceacademy.com has been created. Click the link below to ativate it now:\n".  base_url("account_credential/accountActivation/$activationKey"));
                $this->responseDebug($emailResponse);
                $this->actionLog($result);
                $this->responseData($result);
            }else{
                $this->responseError(3, "Failed to create");
            }
        }else{
            $errorArray = $this->formValidationError();
            if(isset($errorArray["username"]) && $errorArray["username"] == "username already used."){
                $this->responseError(6, "User already added");
            }
            if(count($errorArray)){
                $this->responseError(102, $errorArray);
            }else{
                $this->responseError(100, "Required Fields are empty");
            }
        }
        $this->outputResponse();
    }
    
    public function retrieveAccount(){
        $this->accessNumber = 2;
        if($this->checkACL()){
            if(!$this->checkACL(64)){// accessNumber = 64 if not admin
                $this->formValidationSetRule('ID', 'ID', 'required');
            }
            if($this->formValidationRun()){//accessNumber 32 
                $ID = $this->input->post("ID");
                $result = $this->m_account->retrieveAccount(
                        $this->input->post("retrieve_type"),
                        $this->input->post("limit"),
                        $this->input->post("offset"),
                        $this->input->post("sort"),
                        $ID,
                        $this->input->post("condition")
                        );
                if($this->input->post("limit")){
                    $this->responseResultCount($this->m_account->retrieveAccount(
                        1,
                        NULL,
                        NULL,
                        NULL,
                        $ID, 
                        $this->input->post("condition")
                        ));
                }
                if($result){
                    if($this->input->post("with_educational_background")){
                        $this->load->model("M_educational_background");
                        if(isset($result["ID"])){
                            $result["educational_background"] =$this->M_educational_background->retrieveEducationalBackground(false, NULL, 0, array(), NULL, array(
                                "account_ID" => $result["ID"]
                            ));
                        }else{
                            foreach($result AS $resultKey => $resultValue){
                                $this->responseDebug($resultKey);
                                $result[$resultKey]["educational_background"] = $this->M_educational_background->retrieveEducationalBackground(false, NULL, 0, array(), NULL, array(
                                    "account_ID" => $resultValue["ID"]
                                ));
                            }
                        }
                    }
                    if($this->input->post("with_personal_interest")){
                        $this->load->model("M_personal_interest");
                        if(isset($result["ID"])){
                            $result["personal_interest"] =$this->M_personal_interest->retrievePersonalInterest(false, NULL, 0, array(), NULL, array(
                                "account_ID" => $result["ID"]
                            ));
                        }else{
                            foreach($result AS $resultKey => $resultValue){
                                $this->responseDebug($resultKey);
                                $result[$resultKey]["personal_interest"] = $this->M_personal_interest->retrievePersonalInterest(false, NULL, 0, array(), NULL, array(
                                    "account_ID" => $resultValue["ID"]
                                ));
                            }
                        }
                    }
                    $this->actionLog(json_encode($this->input->post()));
                    $this->responseData($result);
                }else{
                    $this->responseError(2, "No Result");
                }
            }else{
                if(count($this->formValidationError())){
                    $this->responseError(102, $this->formValidationError());
                }else{
                    $this->responseError(100, "Required Fields are empty");
                }
            }
        }else{
            $this->responseError(1, "Not Authorized");
        }
        $this->outputResponse();
    }
    public function updateAccount(){
        $this->accessNumber = 4;
        $hasAdminPrivilige = true;
        if(($this->input->post("updated_data[status]") || $this->input->post("updated_data[account_type_ID]")) && !$this->checkACL(64)){
            $hasAdminPrivilige = false;
        }
        if($this->checkACL() && $hasAdminPrivilige){
            if($this->input->post("updated_data[username]") && $this->input->post("updated_data[username]") != $this->username){
                $this->form_validation->set_rules('updated_data[username]', 'Username', 'alpha_numeric|callback_is_unique_username');
            }
            $this->form_validation->set_rules('updated_data[password]', 'Password', 'min_length[6]');
            ($this->input->post('updated_data[first_name]')) ? $this->form_validation->set_rules('updated_data[first_name]', 'First Name', 'trim|callback_alpha_dash_space') : null;
            ($this->input->post('updated_data[last_name]')) ? $this->form_validation->set_rules('updated_data[last_name]', 'Last Name', 'trim|callback_alpha_dash_space') : null;
            ($this->input->post('updated_data[middle_name]')) ? $this->form_validation->set_rules('updated_data[middle_name]', 'Last Name', 'trim|callback_alpha_dash_space') : null;
            ($this->input->post('updated_data[email_address]')) ? $this->form_validation->set_rules('updated_data[email_address]', 'Email Address', 'trim|valid_email') : null;
            ($this->input->post('updated_data[address]')) ? $this->form_validation->set_rules('updated_data[address]', 'Address', 'trim|callback_alpha_dash_space') : null;
            if($this->form_validation->run()){
                $updatedData = $this->input->post('updated_data');
                $ID = $this->input->post('ID');
                if(!$this->checkACL(64)){
                    $ID = $this->userID;
                }
                $condition = $this->input->post("condition");
                $result = $this->m_account->updateAccount(
                        $ID,
                        $condition,
                        $updatedData
                        );
                $condition["account_ID"] = $ID;
                $result1 = $this->M_account_information->updateAccountInformation(
                        NULL,
                        array("account_information__account_ID" => $ID),
                        $updatedData
                        );
                if($result || $result1){
                    if($this->input->post("new_educational_background")){
                        $this->load->model("M_educational_background");
                        $educationalBackground = $this->input->post("new_educational_background");
                        foreach($educationalBackground as $educationalBackgroundValue){
                            $this->M_educational_background->createEducationalBackground($condition["account_ID"], $educationalBackgroundValue["degree"], $educationalBackgroundValue["school"], $educationalBackgroundValue["academic_year"]);
                        }
                    }
                    if($this->input->post("updated_educational_background")){
                        $this->load->model("M_educational_background");
                        $educationalBackground = $this->input->post("updated_educational_background");
                        foreach($educationalBackground as $educationalBackgroundValue){
                            $this->M_educational_background->updateEducationalBackground($educationalBackgroundValue["ID"], NULL, array(
                                "account_ID" => $ID,
                                "degree" => $educationalBackgroundValue["degree"],
                                "school" => $educationalBackgroundValue["school"],
                                "academic_year" => $educationalBackgroundValue["academic_year"],
                            ));
                        }
                    }
                    if($this->input->post("deleted_educational_background")){
                        $this->load->model("M_educational_background");
                            $this->M_educational_background->deleteEducationalBackground(NULL, array(
                                "ID" => $this->input->post("deleted_educational_background")
                            ));
                    }
                    
                    if($this->input->post("new_personal_interest")){
                        $this->load->model("M_personal_interest");
                        $personalInterest = $this->input->post("new_personal_interest");
                        foreach($personalInterest as $personalInterestValue){
                            $this->M_personal_interest->createPersonalInterest($condition["account_ID"], $personalInterestValue["description"]);
                        }
                    }
                    if($this->input->post("updated_personal_interest")){
                        $this->load->model("M_personal_interest");
                        $personalInterest = $this->input->post("updated_personal_interest");
                        foreach($personalInterest as $personalInterestValue){
                            $this->M_personal_interest->updatePersonalInterest($personalInterestValue["ID"], NULL, array(
                                "account_ID" => $ID,
                                "description" => $personalInterestValue["description"]
                            ));
                        }
                    }
                    if($this->input->post("deleted_personal_interest")){
                        $this->load->model("M_personal_interest");
                            $this->M_personal_interest->deletePersonalInterest(NULL, array(
                                "ID" => $this->input->post("deleted_personal_interest")
                            ));
                    }
                    $this->actionLog(json_encode($this->input->post()));
                    $this->responseData($result || $result1);
                }else{
                    $this->responseError(3, "Failed to Update");
                }
            }else{
                if(count($this->formValidationError())){
                    $this->responseError(102, $this->formValidationError());
                }else{
                    $this->responseError(100, "Required Fields are empty");
                }
            }
        }else{
            $this->responseError(1, "Not Authorized");
        }
        $this->outputResponse();
    }
    
    public function deleteAccount(){
        $this->accessNumber = 8;
        if($this->checkACL()){
            $result = $this->m_account->deleteAccount(
                    $this->input->post("ID"), 
                    $this->input->post("condition")
                    );
            if($result){
                $this->actionLog(json_encode($this->input->post()));
                $this->responseData($result);
            }else{
                $this->responseError(3, "Failed to delete");
            }
        }else{
            $this->responseError(1, "Not Authorized");
        }
        $this->outputResponse();
    }
    public function alpha_dash_space($str){
        $this->form_validation->set_message('alpha_dash_space', '{field} only accepts alphabets and spaces');
        return ( !preg_match('/^[ a-z - ñÑ]+$/iu', $str)) ? false : true;
    }
    public function is_unique_username($str){
        $this->load->model("M_account");
        $result = $this->m_account->retrieveAccount(false, NULL, 0, array(), NULL, array(
            "username"=>$str
        ));
        $this->form_validation->set_message('is_unique_username', '{field} already used.');
        if($result){
            return false;
        }else{
            return true;
        }
    }
    public function validReCaptcha(){
        return true;
        /*
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6Ld26BkTAAAAAHFkrfknWzaQhRkey-edRO5KEMU0', 
            'response' => $this->input->post("g-recaptcha-response")
                );

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result, true);
        return $response["success"];*/
    }
}