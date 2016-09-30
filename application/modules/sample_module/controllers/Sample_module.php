<?php

/* Created by John Enrick Pleños */
class Sample_module extends FE_Controller{
    public function index(){
        if(!$this->input->post("load_module")){
            $this->loadPage("sample_module");
        }else{
            $this->loadModule("sample_module", "sample_module_script");
        }
    }
}

