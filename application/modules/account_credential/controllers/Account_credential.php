<?php

/* Created by John Enrick Pleños */
class Account_credential extends FE_Controller{
    public function accountActivation($activationCode){
        if(!$this->input->post("load_module")){
            $this->loadPage("account_credential/accountActivation/$activationCode");
        }else{
            $this->loadModule("account_activation", "account_activation_script");
        }
    }
}

