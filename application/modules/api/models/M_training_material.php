<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_training_material
 *
 * @author johnenrick
 */
class M_training_material extends API_Model{
    public function __construct() {
        parent::__construct();
        $this->TABLE = "training_material";
    }
    public function createTrainingMaterial($description, $trainingModuleID, $trainingModuleGroupID, $fileUploadedID, $uploaderAccountID){
        $newData = array(
            "description" => $description,
            "training_module_ID" => $trainingModuleID,
            "training_module_group_ID" => $trainingModuleGroupID,
            "file_uploaded_ID" => $fileUploadedID,
            "datetime" => time(),
            "uploader_account_ID" => $uploaderAccountID
        );
        return $this->createTableEntry($newData);
    }
    public function retrieveTrainingMaterial($retrieveType = false, $limit = NULL, $offset = 0, $sort = array(), $ID = NULL, $condition = NULL) {
        $joinedTable = array(
            "training_module" => "training_module.ID=training_material.training_module_ID",
            "file_uploaded" => "file_uploaded.ID=training_material.file_uploaded_ID"
        );
        $selectedColumn = array(
            "training_material.*",
            "training_module.description AS training_module_description",
            "file_uploaded.description AS file_uploaded_description, file_uploaded.file_type AS file_uploaded_file_type"
        );
        
        return $this->retrieveTableEntry($retrieveType, $limit, $offset, $sort, $ID, $condition, $selectedColumn, $joinedTable);
    }
    public function updateTrainingMaterial($ID = NULL, $condition = array(), $newData = array()) {
        return $this->updateTableEntry($ID, $condition, $newData);
    }
    public function deleteTrainingMaterial($ID = NULL, $condition = array()){
        return $this->deleteTableEntry($ID, $condition);
    }
}
