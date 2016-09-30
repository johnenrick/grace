<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_personal_interest
 *
 * @author johnenrick
 */
class M_personal_interest extends API_Model{
    public function __construct() {
        parent::__construct();
        $this->TABLE = "personal_interest";
    }
    public function createPersonalInterest($accountID, $description){
        $newData = array(
            "account_ID" => $accountID,
            "description" => $description
        );
        return $this->createTableEntry($newData);
    }
    public function retrievePersonalInterest($retrieveType = false, $limit = NULL, $offset = 0, $sort = array(), $ID = NULL, $condition = NULL) {
        $joinedTable = array(
        );
        $selectedColumn = array(
            "personal_interest.*"
        );
        
        return $this->retrieveTableEntry($retrieveType, $limit, $offset, $sort, $ID, $condition, $selectedColumn, $joinedTable);
    }
    public function updatePersonalInterest($ID = NULL, $condition = array(), $newData = array()) {
        return $this->updateTableEntry($ID, $condition, $newData);
    }
    public function deletePersonalInterest($ID = NULL, $condition = array()){
        return $this->deleteTableEntry($ID, $condition);
    }
}
