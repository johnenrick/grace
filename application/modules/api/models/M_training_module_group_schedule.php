<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_training_module_group_schedule
 *
 * @author johnenrick
 */
class M_training_module_group_schedule extends API_Model{
    public function __construct() {
        parent::__construct();
        $this->TABLE = "training_module_group_schedule";
    }
    public function createTrainingModuleGroupSchedule($trainingModuleGroupID, $day, $startTime, $endTime){
        $newData = array(
            "training_module_group_ID" => $trainingModuleGroupID,
            "day" => $day,
            "start_time" => $startTime,
            "end_time" => $endTime

        );
        return $this->createTableEntry($newData);
    }
    public function retrieveTrainingModuleGroupSchedule($retrieveType = false, $limit = NULL, $offset = 0, $sort = array(), $ID = NULL, $condition = NULL) {
        $joinedTable = array(
        );
        $selectedColumn = array(
            "training_module_group_schedule.*"
            
        );
        
        return $this->retrieveTableEntry($retrieveType, $limit, $offset, $sort, $ID, $condition, $selectedColumn, $joinedTable);
    }
    public function updateTrainingModuleGroupSchedule($ID = NULL, $condition = array(), $newData = array()) {
        return $this->updateTableEntry($ID, $condition, $newData);
    }
    public function deleteTrainingModuleGroupSchedule($ID = NULL, $condition = array()){
        return $this->deleteTableEntry($ID, $condition);
    }
}
