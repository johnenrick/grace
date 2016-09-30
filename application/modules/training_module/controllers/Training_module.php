<?php

/* Created by John Enrick Pleños */
class Training_module extends FE_Controller{
    public function index(){
        if(!$this->input->post("load_module")){
            $this->loadPage("training_module");
        }else{
            $this->loadModule("training_module", "training_module_script");
        }   
    }
    public function moduleManagementTab(){
        $this->loadModule("module_management", "module_management_script");
    }
    public function groupManagementTab(){
        $this->loadModule("group_management", "group_management_script");
    }
    public function trainingMaterialTab(){
        $this->loadModule("training_material", "training_material_script");
    }
}

