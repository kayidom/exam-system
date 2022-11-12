<?php

class Exams extends DBConnection {
    private $db = null;

    public function __construct() {
        $this->db = parent::connect();
    }

    public function insertExam($data, $filename) {
        $row = $this->db->prepare("INSERT INTO `exam_output`(`ModCode`, `StartTime`, `UploadTime`, `DateExam`, `AnswerPaperPDF`) 
                                VALUES (:ModCode, :StartTime, :UploadTime, :DateExam,  :num_of_questions, :filename) ");
        $results = $row->execute([
            ':ModCode' => $data['ModCode'],
            ':StartTime' => $data['StartTime'],
            ':UploadTime' => $data['UploadTime'],
            
            ':DateExam' => $data['DateExam'],
            ':AnswerPaperPDF' => $data['AnswerPaperPDF'],
            // ':num_of_questions' => $data['num_of_questions'],
            ':filename' => $filename,
        ]);
        if($results) {
            return true;
        }
        else {
            return false;
        }
    }

    //WHERE EXTRACT(YEAR_MONTH, exam_date) = DATE_SUB(EXTRACT(YEAR_MONTH, CURRENT_DATE(), INTERVAL 3 MONTH) AND
    public function getAllExamRecords() { 
        $row = $this->db->prepare("SELECT * FROM `exam_output` WHERE `AnswerPaperPDF` <> '' ORDER BY TransactionID DESC");
        $row->execute();
        if($row->rowCount() > 0) {
            return $row->fetchAll(PDO::FETCH_OBJ);
        }
        else {
            return false;
        }
    }

    /*
    public function readExamRecords($examID) {
        $row = $this->db->prepare("SELECT * FROM `examinations` WHERE id =  ? ");
        $row->bindValue(1, $examID);
        $row->execute();
        if($row->rowCount() > 0) {
            return $row->fetch(PDO::FETCH_OBJ);
        }
        else {
            return false;
        }
    }

    public function getStudentExamRecords($studentNumber) {
        $row = $this->db->prepare("SELECT * FROM `examinations` WHERE student_number = ? ");
        $row->bindValue(1, $studentNumber);
        $row->execute();
        if($row->rowCount() > 0) {
            return $row->fetchAll();
        }
        else {
            return false;
        }
    }
// SELECT * FROM `examinations` WHERE student_number = ? AND DATE_FORMAT(start_time, '%m-%Y') > DATE_FORMAT( DATE_SUB(NOW(), INTERVAL 6 MONTH), '%m-%Y') 
    public function getStudentComingExams($studentNumber) {
        $row = $this->db->prepare("SELECT * FROM `admission` 
                                    WHERE `student_number` = ? AND `ModCode` 
                                    IN (SELECT `examinations`.`module_code` FROM `examinations`) ");
        $row->bindValue(1, $studentNumber);
        $row->execute();
        if($row->rowCount() > 0) {
            return $row->fetchAll(PDO::FETCH_OBJ);
        }
        else {
            return false;
        }
    }

    public function getExamInfo($moduleCode) {
        $row = $this->db->prepare("SELECT * FROM `examinations` WHERE module_code = ? ");
        $row->bindValue(1, $moduleCode);
        $row->execute();
        if($row->rowCount() > 0) {
            return $row->fetch(PDO::FETCH_OBJ);
        }
        else {
            return false;
        }
    }

    public function getStudentExamByType($studentNumber, $examType) {
        $row = $this->db->prepare("SELECT * FROM `examinations` WHERE student_number = ? AND exam_type");
        $row->bindValue(1, $studentNumber);
        $row->execute();
        if($row->rowCount() > 0) {
            return $row->fetchAll();
        }
        else {
            return false;
        }
    }

    

    public function updateExamTable($data) {
        $row = $this->db->prepare("UPDATE `examinations` 
                                    SET `module_code`= :module_code, `exam_type`= :exam_type, `exam_date`= :exam_date, `start_time`= :start_time, `end_time`= :end_time, `number_of_questions`= :num_of_questions
                                      WHERE `id`= :exam_id ");
        $results = $row->execute([
            ':module_code' => $data['module_code'],
            ':exam_type' => $data['exam_type'],
            ':exam_date' => $data['exam_date'],
            ':start_time' => $data['start_time'],
            ':end_time' => $data['end_time'],
            ':num_of_questions' => $data['num_of_questions'],
            ':exam_id' => $data['exam_id'],
        ]);
        if($results) {
            return true;
        }
        else {
            return false;
        }
    }

    public function changeExamDocument($examID, $filename) {
        $row = $this->db->prepare("UPDATE `examinations` SET `file_document`= :filename WHERE `id`= :examID ");
        $results = $row->execute([
            ':filename' => $filename,
            ':examID' => $examID,
        ]);
        if($results) {
            return true;
        }
        else {
            return false;
        }
    }

    public function studentExamSubmission($studentNumber, $moduleCode, $filename) {
        $row = $this->db->prepare("INSERT INTO `examinfo`(`student_number`, `module_code`, `declaration`, `upload`) 
                                    VALUES (:studentNumber, :moduleCode, :declaration, :filename) " );
        $results = $row->execute([
            ':studentNumber' => $studentNumber,
            ':moduleCode' => $moduleCode,
            ':declaration' => "Yes",
            ':filename' => $filename,
        ]);
        if($results) {
            return true;
        }
        else {
            return false;
        }
    }*/

}

?>