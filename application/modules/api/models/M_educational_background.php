<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_educational_background
 *
 * @author johnenrick
 */
class M_educational_background extends API_Model{
    public function __construct() {
        parent::__construct();
        $this->TABLE = "educational_background";
    }
    public function createEducationalBackground($accountID, $degree, $school, $academicYear){
        $newData = array(
            "account_ID" => $accountID,
            "degree" => $degree,
            "school" => $school,
            "academic_year" => $academicYear
        );
        return $this->createTableEntry($newData);
    }
    public function retrieveEducationalBackground($retrieveType = false, $limit = NULL, $offset = 0, $sort = array(), $ID = NULL, $condition = NULL) {
        $joinedTable = array(
        );
        $selectedColumn = array(
            "educational_background.*"
        );
        
        return $this->retrieveTableEntry($retrieveType, $limit, $offset, $sort, $ID, $condition, $selectedColumn, $joinedTable);
    }
    public function updateEducationalBackground($ID = NULL, $condition = array(), $newData = array()) {
        return $this->updateTableEntry($ID, $condition, $newData);
    }
    public function deleteEducationalBackground($ID = NULL, $condition = array()){
        return $this->deleteTableEntry($ID, $condition);
    }
}
