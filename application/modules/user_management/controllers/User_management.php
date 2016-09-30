<?php

/* Created by John Enrick Pleños */
class User_management extends FE_Controller{
    
    public function index(){
        if(!$this->input->post("load_module")){
            $this->loadPage("user_management");
        }else{
            $this->loadModule("user_management", "user_management_script");
        }
    }
}

