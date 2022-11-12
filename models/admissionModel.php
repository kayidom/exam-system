<?php


class Admission extends DBConnection {
     private $db = null;

     public function __construct() {
          $this->db = parent::connect();
     }

     public function is_student_registered($studNumer) {
          $row = $this->db->prepare("SELECT * FROM `admission` WHERE StudentNumber =  ?");
          $row->bindValue(1, $studNumer);
          $row->execute();
          if($row->rowCount() > 0) {
               return true;
          }
          else {
               return 0;
          }
     }

     public function getAllAdmissions() {
          $row = $this->db->prepare("SELECT * FROM `admission`");
          $row->execute();
          if($row->rowCount() > 0) {
               return $row->fetchAll(PDO::FETCH_OBJ);
          }
          else {
               return 0;
          }
     }

     public function getAllStudentAdmission($studentNumber) {
          $row = $this->db->prepare("SELECT DISTINCT(ModCode), StudentNumber FROM `admission` WHERE StudentNumber =  ?");
          $row->bindValue(1, $studentNumber);
          $row->execute();
          if($row->rowCount() > 0) {
               return $row->fetchAll(PDO::FETCH_OBJ);
          }
          else {
               return false;
          }
     }

    public function getAdmissionInfo($studentNumber) {
        $row = $this->db->prepare("SELECT * FROM `admission` WHERE StudentNumber = ?");
        $row->bindValue(1, $studentNumber);
        $row->execute();
        if($row->rowCount() > 0) {
             return $row->fetch(PDO::FETCH_OBJ);
        }
        else {
             return 0;
        }
    }

}


?>