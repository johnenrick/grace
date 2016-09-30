<?php

/* Created by John Enrick Pleños */

class Test_page extends FE_Controller{
    public function videoPlayer(){
        if($this->input->post("load_module")){
            $this->loadModule("video", "video_script");
        }else{
            $this->loadPage("Test_page/videoPlayer");
        }
    }

    public function registrationForm(){
    	if($this->input->post("load_module")){
            $this->loadModule("registration", "registration_script");
        }else{
            $this->loadPage("Test_page/registrationForm");
        }
    }

    public function category(){
        if($this->input->post("load_module")){
            $this->loadModule("category", "category_script");
        }else{
            $this->loadPage("Test_page/category");
        }
    }
    
}