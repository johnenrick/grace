<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of portal
 *
 * @author johnenrick
 */
class System_application extends FE_Controller{
    //put your code here
    function loadPageComponent(){
        $this->load->view("page_component/".$this->input->post("component"));
        $this->load->view("page_component/".$this->input->post("component")."_script");
    }
    function sendContactMessage(){
        
    }
}
