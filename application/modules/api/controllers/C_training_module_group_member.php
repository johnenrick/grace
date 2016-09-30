<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_training_module_group_member extends API_Controller {
    /*
     * Access Control List
     * 1    - createTrainingModuleGroupMember
     * 2    - retrieveTrainingModuleGroupMember
     * 4    - updateTrainingModuleGroupMember
     * 8    - deleteTrainingModuleGroupMember
     * 16   - batchCreateTrainingModuleGroupMember
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("m_training_module_group_member");
        $this->APICONTROLLERID = 1;
    }
    public function createTrainingModuleGroupMember(){
        $this->accessNumber = 1;
        if($this->checkACL()){
            $this->formValidationSetRule('training_module_group_ID', 'Module Group', 'required');
            $this->formValidationSetRule('member_account_ID', 'Member', 'required');
            
            if($this->formValidationRun()){
                $result = $this->m_training_module_group_member->createTrainingModuleGroupMember(
                        $this->input->post("training_module_group_ID"),
                        $this->input->post("member_account_ID")
                        );
                if($result){
                    $this->actionLog($result);
                    $this->responseData($result);
                }else{
                    $this->responseError(3, "Failed to create");
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
    public function retrieveTrainingModuleGroupMember(){
        $this->accessNumber = 2;
        if($this->checkACL()){
            $result = $this->m_training_module_group_member->retrieveTrainingModuleGroupMember(
                    $this->input->post("retrieve_type"),
                    $this->input->post("limit"),
                    $this->input->post("offset"), 
                    $this->input->post("sort"),
                    $this->input->post("ID"), 
                    $this->input->post("condition")
                    );
            if($this->input->post("limit")){
                $this->responseResultCount($this->m_training_module_group_member->retrieveTrainingModuleGroupMember(
                    1,
                    NULL,
                    NULL,
                    NULL,
                    $this->input->post("ID"), 
                    $this->input->post("condition")
                    ));
            }
            if($result){
                $this->actionLog(json_encode($this->input->post()));
                $this->responseData($result);
            }else{
                $this->responseError(2, "No Result");
            }
        }else{
            $this->responseError(1, "Not Authorized");
        }
        $this->outputResponse();
    }
    public function updateTrainingModuleGroupMember(){
        $this->accessNumber = 4;
        if($this->checkACL()){
            
            $result = $this->m_training_module_group_member->updateTrainingModuleGroupMember(
                    $this->input->post("ID"),
                    $this->input->post("condition"),
                    $this->input->post("updated_data")
                    );
            if($result){
                $this->actionLog(json_encode($this->input->post()));
                $this->responseData($result);
            }else{
                $this->responseError(3, "Failed to Update");
            }
        }else{
            $this->responseError(1, "Not Authorized");
        }
        $this->outputResponse();
    }
    public function deleteTrainingModuleGroupMember(){
        $this->accessNumber = 8;
        if($this->checkACL()){
            $result = $this->m_training_module_group_member->deleteTrainingModuleGroupMember(
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
}
