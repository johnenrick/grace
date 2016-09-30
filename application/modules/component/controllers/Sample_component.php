<?php

/* Created by John Enrick Pleños */
class Sample_component extends FE_Controller{
    public function index(){
        $this->loadComponent("sample_component/sample_component", "sample_component/sample_component");
    }
}

