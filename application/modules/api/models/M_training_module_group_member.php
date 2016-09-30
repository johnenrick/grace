<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_training_module_group_member
 *
 * @author johnenrick
 */
class M_training_module_group_member extends API_Model{
    public function __construct() {
        parent::__construct();
        $this->TABLE = "training_module_group_member";
    }
    public function createTrainingModuleGroupMember($trainingModuleGroupID, $memberAccountID){
        $newData = array(
            "training_module_group_ID" => $trainingModuleGroupID,
            "member_account_ID" => $memberAccountID
        );
        return $this->createTableEntry($newData);
    }
    public function retrieveTrainingModuleGroupMember($retrieveType = false, $limit = NULL, $offset = 0, $sort = array(), $ID = NULL, $condition = NULL) {
        $joinedTable = array(
            "account_information" => "account_information.account_ID=training_module_group_member.member_account_ID"
        );
        $selectedColumn = array(
            "training_module_group_member.*",
            "account_information.*"
        );
        
        return $this->retrieveTableEntry($retrieveType, $limit, $offset, $sort, $ID, $condition, $selectedColumn, $joinedTable);
    }
    public function updateTrainingModuleGroupMember($ID = NULL, $condition = array(), $newData = array()) {
        return $this->updateTableEntry($ID, $condition, $newData);
    }
    public function deleteTrainingModuleGroupMember($ID = NULL, $condition = array()){
        return $this->deleteTableEntry($ID, $condition);
    }
}
