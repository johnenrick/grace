<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_training_module_group
 *
 * @author johnenrick
 */
class M_training_module_group extends API_Model{
    public function __construct() {
        parent::__construct();
        $this->TABLE = "training_module_group";
    }
    public function createTrainingModuleGroup($trainingModuleID, $instructorAccountID, $startDatetime, $endDatetime){
        $newData = array(
            "training_module_ID" => $trainingModuleID,
            "instructor_account_ID" => $instructorAccountID,
            "start_datetime" => $startDatetime,
            "end_datetime" => $endDatetime,

        );
        return $this->createTableEntry($newData);
    }
    public function retrieveTrainingModuleGroup($retrieveType = false, $limit = NULL, $offset = 0, $sort = array(), $ID = NULL, $condition = NULL, $additionalData = array()) {
        $joinedTable = array(
            "training_module" => "training_module.ID=training_module_group.training_module_ID",
            "account_information AS instructor_account_information" => "instructor_account_information.account_ID=training_module_group.instructor_account_ID"
        );
        if(isset($additionalData["training_module_group_schedule"])){
            $joinedTable["training_module_group_schedule"] = "training_module_group_schedule.training_module_group_ID=training_module_group.ID";
        }
        $selectedColumn = array(
            "training_module_group.*",
            "training_module.description AS training_module_description",
            "instructor_account_information.first_name AS instructor_account_information_first_name, instructor_account_information.last_name AS instructor_account_information_last_name, instructor_account_information.middle_name AS instructor_account_information_middle_name"
        );
        
        return $this->retrieveTableEntry($retrieveType, $limit, $offset, $sort, $ID, $condition, $selectedColumn, $joinedTable);
    }
    public function updateTrainingModuleGroup($ID = NULL, $condition = array(), $newData = array()) {
        return $this->updateTableEntry($ID, $condition, $newData);
    }
    public function deleteTrainingModuleGroup($ID = NULL, $condition = array()){
        return $this->deleteTableEntry($ID, $condition);
    }
}
