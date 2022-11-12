<?php

//

class Student extends DBConnection {
    private $db = null;

    public function __construct() {
        $this->db = parent::connect();
    }

    public function login($email, $password) {
        // perform the login process 
        $row = $this->db->prepare("SELECT * FROM students WHERE student_email = ? AND password = ? ORDER BY student_number ASC LIMIT 0,1");
        $row->bindValue(1, $email);
        $row->bindValue(2, $password);
        $row->execute();
        if($row->rowCount() > 0){
            // student submitted the right credentials
            $rec = $row->fetch(PDO::FETCH_OBJ);
            $response['status'] = 1;
            $_SESSION["stud-num"] = $rec->student_number; // indicates the user is logged in
            $_SESSION["stud-auth"] = true;
            return $response;
        } else{
            $response['status'] = 0;
            return $response;
        }
    }
    
    public function is_logged_in() {
        return (isset($_SESSION['stud-auth'])) ? true : false;
    }

    public function student_logout() {
        $_SESSION["stud-auth"] = false;
        unset($_SESSION['stud-auth']);
        unset($_SESSION["stud-num"]);
        session_destroy();
        return true;
    }

    public function getAllStudents() {
       $row = $this->db->prepare("SELECT * FROM students");
       $row->execute();
       if($row->rowCount() > 0) {
            return $row->fetchAll(PDO::FETCH_OBJ);
       }
       else {
            return 0;
       }
    }

    public function getStudentInfo($email) {
        $row = $this->db->prepare("SELECT * FROM students WHERE student_number = ? OR student_email = ?");
        $row->bindValue(1, $email);
        $row->bindValue(2, $email);
        $row->execute();
        if($row->rowCount() > 0) {
             return $row->fetch(PDO::FETCH_OBJ);
        }
        else {
             return 0;
        }
    }

    public function getStudentRegistration() {
       $row = $this->db->prepare("SELECT * FROM `students` WHERE student_number IN (SELECT student_number FROM `admission`)");
       $row->execute();
       if($row->rowCount() > 0) {
            return $row->fetchAll(PDO::FETCH_OBJ);
       }
       else {
            return 0;
       }
    }

    public function searchStudent($searchText) {
        $searchText = "%".$searchText."%";
       $row = $this->db->prepare("SELECT * FROM `students` 
                                WHERE student_number LIKE ? OR student_name LIKE ? OR student_surname LIKE ? OR student_email LIKE ?");
       $row->bindValue(1, $searchText);
       $row->bindValue(2, $searchText);
       $row->bindValue(3, $searchText);
       $row->bindValue(4, $searchText);
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