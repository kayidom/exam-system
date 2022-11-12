<?php

class Modules extends DBConnection {
    private $db = null;

    public function __construct() {
        $this->db = parent::connect();
    }

    public function getAllModules() {
        $row = $this->db->prepare("SELECT * FROM `moduleinfo` ");
        $row->execute();
        if($row->rowCount() > 0) {
            return $row->fetchAll(PDO::FETCH_OBJ);
        }
        else {
            return 0;
        }
    }

    public function getModuleByCode($moduleCode) {
        $row = $this->db->prepare("SELECT * FROM `moduleinfo` WHERE ModCode = ? ");
        $row->bindValue(1, $moduleCode);
        $row->execute();
        if($row->rowCount() > 0) {
            return $row->fetch(PDO::FETCH_OBJ);
        }
        else {
            return 0;
        }
    }

    public function searchModules($searchText) {
        $searchText = "%".$searchText."%";
       $row = $this->db->prepare("SELECT * FROM `moduleinfo` 
                                WHERE ModCode LIKE ? OR Description LIKE ?");
       $row->bindValue(1, $searchText);
       $row->bindValue(2, $searchText);
       $row->execute();
       if($row->rowCount() > 0) {
            return $row->fetchAll(PDO::FETCH_OBJ);
       }
       else {
            return 0;
       }
    }

}

?>