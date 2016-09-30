<?php

/* Created by John Enrick Pleños */
class Profile_management extends FE_Controller{
    public function index(){
        if(!$this->input->post("load_module")){
            $this->loadPage("profile_management");
        }else{
            $this->loadModule("profile_management", "profile_management_script");
        }
    }
}

