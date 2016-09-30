<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_training_material extends API_Controller {
    /*
     * Access Control List
     * 1    - createTrainingMaterial
     * 2    - retrieveTrainingMaterial
     * 4    - updateTrainingMaterial
     * 8    - deleteTrainingMaterial
     * 16   - batchCreateTrainingMaterial
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("m_training_material");
        $this->APICONTROLLERID = 1;
    }
    public function createTrainingMaterial(){
        $this->accessNumber = 1;
        if($this->checkACL()){
            $this->formValidationSetRule('description', 'Description', 'required|min_length[3]');
            $this->formValidationSetRule('training_module_ID', 'Training Module', 'required|greater_than[0]');
            
            if($this->formValidationRun()){
                $fileUploadedResult = $this->uploadFile();
                $this->responseDebug($fileUploadedResult);
                if(!is_string($fileUploadedResult)){
                    $result = $this->m_training_material->createTrainingMaterial(
                            $this->input->post("description"),
                            $this->input->post("training_module_ID"),
                            $this->input->post("training_module_group_ID"),
                            $fileUploadedResult,
                            $this->userID
                            );
                    if($result){
                        $this->actionLog($result);
                        $this->responseData($result);
                    }else{
                        $this->responseError(3, "Failed to create");
                    }
                }else{
                    $this->responseError(4, $fileUploadedResult);
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
    public function retrieveTrainingMaterial(){
        $this->accessNumber = 2;
        if($this->checkACL()){
            $this->formValidationSetRule('description', 'Description', 'required');
            $result = $this->m_training_material->retrieveTrainingMaterial(
                    $this->input->post("retrieve_type"),
                    $this->input->post("limit"),
                    $this->input->post("offset"), 
                    $this->input->post("sort"),
                    $this->input->post("ID"), 
                    $this->input->post("condition")
                    );
            if($this->input->post("limit")){
                $this->responseResultCount($this->m_training_material->retrieveTrainingMaterial(
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
    public function updateTrainingMaterial(){
        $this->accessNumber = 4;
        if($this->checkACL()){
            $this->responseDebug(is_null($this->input->post("updated_data[description]")));
            $this->responseDebug($this->input->post("updated_data[description]"));
            (is_null($this->input->post("updated_data[description]")) == false) ? $this->formValidationSetRule('updated_data[description]', 'Description', 'required|min_length[3]') : null;
            ($this->input->post("updated_data[training_module_ID]") != NULL) ? $this->formValidationSetRule('updated_data[training_module_ID]', 'Training Module', 'required|greater_than[0]') : null;
            if($this->formValidationRun()){
                $result = $this->m_training_material->updateTrainingMaterial(
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
    public function deleteTrainingMaterial(){
        $this->accessNumber = 8;
        if($this->checkACL()){
            $result = $this->m_training_material->deleteTrainingMaterial(
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
    public function uploadFile(){
        if (empty($_FILES['userfile']['name'])) {
            return "No files";
        }
        $this->load->library("upload");
        $path = "assets/user_upload/$this->userID/";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $config['allowed_types']        = '*';
        $config['upload_path']          = $path;
        $config['file_ext_tolower']     = true;
        $this->upload->initialize($config);
        $this->load->library('upload');
        if ($this->upload->do_upload()){
            $uploadData = $this->upload->data();
            $this->load->model("M_file_uploaded");
            return $this->M_file_uploaded->createFileUploaded($uploadData["file_name"], $uploadData["image_type"], $uploadData["file_path"], $uploadData["file_size"]);
        }else{
            $this->responseDebug($this->upload->data());
            $error = $this->upload->display_errors("","");
            return $error;
        }
    }
}
