<?php

/* Created by John Enrick Pleños */
class Training_material extends FE_Controller{
    public function index(){
        if(!$this->input->post("load_module")){
            $this->loadPage("training_material");
        }else{
            $this->loadModule("training_material", "training_material_script");
        }
    }
}

