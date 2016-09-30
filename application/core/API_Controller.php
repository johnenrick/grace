<?php
date_default_timezone_set('Asia/Manila');
/* Created by John Enrick Pleños */
class API_Controller extends MX_Controller{
    public $userID = 0;
    public $userType = 0;
    public $username = NULL;
    
    public $token = null;
    /**
     *
     * @var int $APICONTROLLERID The ID of an API Controller which was indicated in the api_controller table in database
     */
    public $APICONTROLLERID = 0;
    /**
     *
     * @var int $response The response object of any API request
     */
    public $response = array(
        "data" => false,
        "error" => array(),
        "token" => null
    );
    /**
     *
     * @var int $accessNumber The ID number set by the checkACL function
     */
    public $accessNumber = 0;
    
    public function __construct() {
        parent::__construct();
        $this->load->model("api/m_access_control_list");
        $this->load->model("api/m_action_log");
        $this->form_validation->CI =&$this;
        $tokenHeader = isset($_SERVER["HTTP_TOKEN"]) ? $_SERVER["HTTP_TOKEN"] : $this->input->get_request_header("HTTP_TOKEN");//change HTTP_TOKEN to token in local
        $token = decodeToken($tokenHeader);
        if($token != 0 && $token != -1){
            $this->userID = $token["user_ID"]*1;
            $this->userType = $token["user_type"]*1;
            $this->username = $token["username"];
            $this->response["token"] = generateToken($this->userID, $this->userType, $this->username);
        }else if($token == -1){//Expired Token
            $this->response["token"] = null;
            if($this->APICONTROLLERID != 0){
                $this->responseError("1001", "Token Expired.");
                $this->outputResponse();
            }
        }else{//no token
            $this->responseDebug("no token");
        }
        //sleep(2);//Simulate slow internet connection
    }
    /**
     * Add an error data in the response of the API request
     * Error Codes: 
     *  CI Form Validattion Error: 100-999
     *  System Error : 1000-9999
     * @param int $status The status number of the error
     * @param string $message The message of the error
     */
    public function responseError($status, $message = false){
        /*
         * Status
         * 1-99 : Normal Error
         * 100-199 : Form Validation Error
         * 200-299 : System and Security Error
         */
        if($message == false){
            switch($status){
                case 1001 : $message = "Not Logged in";
            }
        }
        $this->response["error"][] = array("status" => $status, "message" => $message);
    }
    /**
     * Add a data to response of the API request
     * @param object $data The data to be added to the response
     */
    public function responseData($data){
        $this->response["data"] = $data;
    }
    /**
     * Add the total result count when there is no limit in the query
     * @param type $count
     */
    public function responseResultCount($count){
        $this->response["result_count"] = $count;
    }
    /**
     * Add a debugging information to the response
     * @param object $data Debugging message
     */
    public function responseDebug($data){
        $this->response["debug"][] = $data;
    }
    /**
     * Echo the response of an API request and end the process
     */
    public function outputResponse(){
        echo json_encode($this->response);
        exit();
    }
    /**
     * Check if a user is authorize
     * 
     * @param type $subAccessNumber The access number of a function of an API controller
     */
    public function checkACL($subAccessNumber = NULL){
        //check module with parent
        return true;//$this->m_access_control_list->checkGoupACL(user_id(), $this->APICONTROLLERID, ($subAccessNumber === NULL ) ? $this->accessNumber : $subAccessNumber);
    }
    public function actionLog($detail){
        //check module with parent
        return $this->m_action_log->createActionLog(($this->userID) ? $this->userID: 0 , $this->APICONTROLLERID, $this->accessNumber, $detail);
    }
    public function printR($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    public function is_associative(array $array) {
        return count(array_filter(array_keys($array), 'is_string')) > 0;
    }
    public function sendEmail($subject, $recipient, $message){
//        $config['protocol']    = 'smtp';
//        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
//        $config['smtp_port']    = '465';
//        $config['smtp_timeout'] = '7';
//        $config['smtp_user']    = 'johnenrickplenos@gmail.com';
//        $config['smtp_pass']    = '11104459john;';
//        $config['charset']    = 'iso-8859-1';
//        $config['newline']    = "\r\n";
//        $config['mailtype'] = 'html'; // or html
//        $config['validation'] = TRUE; // bool whether to validate email or not   
        $config['protocol'] = "sendmail";
        $config['mailpath'] = "/usr/sbin/sendmail";
        $config['charset'] = "iso-8859-1";
        $config['wordwrap'] = TRUE;
        $this->load->library('email');
        $this->email->initialize($config); 
        $this->email->from('johnenrickplenos@gmail.com', 'My GRACE Academy');
        $this->email->to($recipient); 
        $this->email->bcc('johnenrickplenos@gmail.com'); 

        $this->email->subject($subject);
        $this->email->message($message);	
        return $this->email->send();

//        echo $this->email->print_debugger();
    }
    /***
     * Validation for an array of fields
     */
    public function batchValidation($batchEntry, $requiredField){
        $errorList = array();
        foreach($batchEntry as $batchEntryValue){
            $error = array();
            foreach($requiredField as $requiredFieldKey => $requiredFieldValue){
                if(!isset($batchEntryValue[$requiredFieldValue])){
                    $error[] = $requiredFieldValue;
                }
            }
            if(count($error) > 0){
                $errorList[] = $error;
            }
        }
        return (count($errorList) > 0) ? $errorList : true;
    }
    public function stripHTMLtags($str){
        $t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
        return htmlentities($t, ENT_QUOTES, "UTF-8");;
    }
    
    /*** Customer Validation Function ***/
    public $formValidationError = array();
    public $formValidationRules = array();
    /***
     * return the error in form validation
     */
    public function formValidationRun(){
        return (count($this->formValidationError) > 0) ? false :  ((count($this->formValidationRules)) ? $this->form_validation->run() : true);
    }
    /***
     * This is an alternative for getting errors from validation. This is used to get errors from custom validation error
     */
    public function formValidationError(){
        return array_merge($this->formValidationError, $this->form_validation->error_array());
    }
    /***
     * A custom validation for required failed
     */
    public function formValidationSetRule($fieldName, $fieldTitle, $rule){
        $this->form_validation->set_rules($fieldName, $fieldTitle, $rule);
        $this->formValidationRules[] = array($fieldName, $fieldTitle, $rule);
        if(substr_count($rule, "required") && !$this->input->post($fieldName)){
            $this->formValidationError[$fieldName] = "$fieldTitle is required";
        }
    }
    public function is_unique($value, $tableColumn){
        if($value){
            $this->load->model("m_form_validation");
            $this->form_validation->set_message('does_exist', '{field} already exist');
            $doesExist = $this->m_form_validation->doesExist($tableColumn, $value);
            if($doesExist){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
    function in_table($value, $tableColumn){
        if($value){
            $this->load->model("m_form_validation");
            $this->form_validation->set_message('does_not_exist', '{field} does not exist');
            $doesExist = $this->m_form_validation->doesExist($tableColumn, $value);
            if($doesExist){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}

