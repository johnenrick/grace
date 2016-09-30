<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_training_module extends API_Controller {
    /*
     * Access Control List
     * 1    - createTrainingModule
     * 2    - retrieveTrainingModule
     * 4    - updateTrainingModule
     * 8    - deleteTrainingModule
     * 16   - batchCreateTrainingModule
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("m_training_module");
        $this->APICONTROLLERID = 1;
    }
    public function createTrainingModule(){
        $this->accessNumber = 1;
        if($this->checkACL()){
            $this->formValidationSetRule('description', 'Description', 'required');
            
            if($this->formValidationRun()){
                $result = $this->m_training_module->createTrainingModule(
                        $this->input->post("description")
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
    public function retrieveTrainingModule(){
        $this->accessNumber = 2;
        if($this->checkACL()){
            $result = $this->m_training_module->retrieveTrainingModule(
                    $this->input->post("retrieve_type"),
                    $this->input->post("limit"),
                    $this->input->post("offset"), 
                    $this->input->post("sort"),
                    $this->input->post("ID"), 
                    $this->input->post("condition"),
                    $this->input->post("additional_data")
                    );
            if($this->input->post("limit")){
                $this->responseResultCount($this->m_training_module->retrieveTrainingModule(
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
    public function updateTrainingModule(){
        $this->accessNumber = 4;
        if($this->checkACL()){
            
            $result = $this->m_training_module->updateTrainingModule(
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
    public function deleteTrainingModule(){
        $this->accessNumber = 8;
        if($this->checkACL()){
            $result = $this->m_training_module->deleteTrainingModule(
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
