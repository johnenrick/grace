<?php

/* Created by John Enrick Pleños */
class Grid_list extends FE_Controller{
    public function index(){
        $this->loadComponent("grid_list/grid_list", "grid_list/grid_list");
    }
}

