<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_training_module
 *
 * @author johnenrick
 */
class M_training_module extends API_Model{
    public function __construct() {
        parent::__construct();
        $this->TABLE = "training_module";
    }
    public function createTrainingModule($description){
        $newData = array(
            "description" => $description
        );
        return $this->createTableEntry($newData);
    }
    public function retrieveTrainingModule($retrieveType = false, $limit = NULL, $offset = 0, $sort = array(), $ID = NULL, $condition = array(), $additionalData = array()) {
        $joinedTable = array(
        );
        if(isset($additionalData["instructor_account_ID"])){
            $joinedTable["training_module_group"] = "training_module_group.training_module_ID=training_module.ID";
            $condition["training_module_group__instructor_account_ID"] = $additionalData["instructor_account_ID"];
        }
        $selectedColumn = array(
            "training_module.*"
        );
        
        return $this->retrieveTableEntry($retrieveType, $limit, $offset, $sort, $ID, $condition, $selectedColumn, $joinedTable);
    }
    public function updateTrainingModule($ID = NULL, $condition = array(), $newData = array()) {
        return $this->updateTableEntry($ID, $condition, $newData);
    }
    public function deleteTrainingModule($ID = NULL, $condition = array()){
        return $this->deleteTableEntry($ID, $condition);
    }
}
