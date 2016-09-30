<?php

/* Created by John Enrick Pleños */
class Table_component extends FE_Controller{
    public function index(){
        $this->loadComponent("table_component/table_component", "table_component/table_component");
    }
}

