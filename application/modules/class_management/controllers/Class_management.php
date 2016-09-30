<?php

/* Created by John Enrick Pleños */
class Class_management extends FE_Controller{
    
    public function index(){
        if(!$this->input->post("load_module")){
            $this->loadPage("class_management");
        }else{
            $this->loadModule("class_management", "class_management_script");
        }
    }
}

