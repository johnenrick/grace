<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_training_module_group extends API_Controller {
    /*
     * Access Control List
     * 1    - createTrainingModuleGroup
     * 2    - retrieveTrainingModuleGroup
     * 4    - updateTrainingModuleGroup
     * 8    - deleteTrainingModuleGroup
     * 16   - batchCreateTrainingModuleGroup
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("m_training_module_group");
        $this->APICONTROLLERID = 1;
    }
    public function createTrainingModuleGroup(){
        $this->accessNumber = 1;
        if($this->checkACL()){
            $this->formValidationSetRule('training_module_ID', 'Training Module ID', 'required|callback_in_table[training_module.ID]');
            $this->formValidationSetRule('instructor_account_ID', 'Instructor Account ID', 'required|callback_in_table[account.ID]');
            $this->formValidationSetRule('start_datetime', 'Start Datetime', 'required');
            $this->formValidationSetRule('end_datetime', 'End Datetime', 'required');
            if($this->formValidationRun()){
                $result = $this->m_training_module_group->createTrainingModuleGroup(
                        $this->input->post("training_module_ID"),
                        $this->input->post("instructor_account_ID"),
                        $this->input->post("start_datetime"),
                        $this->input->post("end_datetime")
                        );
                if($result){
                    if($this->input->post("new_schedule")){
                        $this->load->model("M_training_module_group_schedule");
                        $schedule = $this->input->post("new_schedule");
                        foreach($schedule as $scheduleValue){
                            $this->M_training_module_group_schedule->createTrainingModuleGroupSchedule($result, $scheduleValue["day"], $scheduleValue["start_time"], $scheduleValue["end_time"]);
                        }
                    }
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
    public function retrieveTrainingModuleGroup(){
        $this->accessNumber = 2;
        if($this->checkACL()){
            $result = $this->m_training_module_group->retrieveTrainingModuleGroup(
                    $this->input->post("retrieve_type"),
                    $this->input->post("limit"),
                    $this->input->post("offset"), 
                    $this->input->post("sort"),
                    $this->input->post("ID"), 
                    $this->input->post("condition"),
                    $this->input->post("additional_data")
                    );
            if($this->input->post("limit")){
                $this->responseResultCount($this->m_training_module_group->retrieveTrainingModuleGroup(
                    1,
                    NULL,
                    NULL,
                    NULL,
                    $this->input->post("ID"), 
                    $this->input->post("condition"),
                    $this->input->post("additional_data")
                    ));
            }
            if($result){
                if($this->input->post("with_training_module_group_schedule")){
                    $this->load->model("M_training_module_group_schedule");
                    if(isset($result["ID"])){
                        $result["training_module_group_schedule"] =$this->M_training_module_group_schedule->retrieveTrainingModuleGroupSchedule(false, NULL, 0, array(), NULL, array(
                            "training_module_group_ID" => $result["ID"]
                        ));
                    }else{
                        foreach($result AS $resultKey => $resultValue){
                            $this->responseDebug($resultKey);
                            $result[$resultKey]["training_module_group_schedule"] = $this->M_training_module_group_schedule->retrieveTrainingModuleGroupSchedule(false, NULL, 0, array(), NULL, array(
                                "training_module_group_ID" => $resultValue["ID"]
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
            $this->responseError(1, "Not Authorized");
        }
        $this->outputResponse();
    }
    public function updateTrainingModuleGroup(){
        $this->accessNumber = 4;
        if($this->checkACL()){
            
            $result = $this->m_training_module_group->updateTrainingModuleGroup(
                    $this->input->post("ID"),
                    $this->input->post("condition"),
                    $this->input->post("updated_data")
                    );
            if($result){
                if($this->input->post("new_schedule")){
                    $this->load->model("M_training_module_group_schedule");
                    $schedule = $this->input->post("new_schedule");
                    $this->responseDebug($schedule);
                    foreach($schedule as $scheduleValue){
                        $this->M_training_module_group_schedule->createTrainingModuleGroupSchedule($scheduleValue["training_module_group_ID"], $scheduleValue["day"], $scheduleValue["start_time"], $scheduleValue["end_time"]);
                    }
                }
                if($this->input->post("updated_schedule")){
                    $this->load->model("M_training_module_group_schedule");
                    $schedule = $this->input->post("updated_schedule");
                    $this->responseDebug($schedule);
                    foreach($schedule as $scheduleValue){
                        $this->M_training_module_group_schedule->updateTrainingModuleGroupSchedule($scheduleValue["ID"], NULL, array(
                            "day" => $scheduleValue["day"],
                            "start_time" => $scheduleValue["start_time"],
                            "end_time" => $scheduleValue["end_time"],
                        ));
                    }
                }
                if($this->input->post("deleted_schedule")){
                    $this->load->model("M_training_module_group_schedule");
                        $this->M_training_module_group_schedule->deleteTrainingModuleGroupSchedule(NULL, array(
                            "ID" => $this->input->post("deleted_schedule")
                        ));
                }
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
    public function deleteTrainingModuleGroup(){
        $this->accessNumber = 8;
        if($this->checkACL()){
            $result = $this->m_training_module_group->deleteTrainingModuleGroup(
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
