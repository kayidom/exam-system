<?php
//all about db functions

class Reports extends DBConnection {
    private $db = null;

    public function __construct() {
        $this->db = parent::connect();
    }

    public function summaryReportStudentModuleAdmission() {
        $row = $this->db->prepare("SELECT DISTINCT(module_code) 'MODULE', COUNT(student_number) AS 'TOTAL'
                                FROM `admission` 
                                WHERE student_number 
                                IN (SELECT student_number FROM `students`)
                                GROUP BY MODULE HAVING TOTAL > 3");
        $row->execute();
        return $row->fetchAll(PDO::FETCH_OBJ);
    }

    public function predictiveReportSubmissions() {
        $row = $this->db->prepare("SELECT COUNT(module_code) 'SUBMITTED', monthname(exam_date) 'MONTH'
                                FROM `examinations`
                                GROUP BY `MONTH` 
                                ORDER BY extract(month from exam_date)" );
        $row->execute();
        return $row->fetchAll(PDO::FETCH_OBJ);
    }

    public function trendWeeklyReport() {
        $row = $this->db->prepare("SELECT COUNT(module_code) 'TOTAL',
                                    DAYNAME(exam_date) 'DAYS'
                                    FROM `examinations`
                                    GROUP BY DAYS
                                    ORDER BY DAYS");
        $row->execute();
        return $row->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function trendReportSession() {
        $row = $this->db->prepare("SELECT DISTINCT(module_code) 'MODULE', start_time 'MORNING_SESSION'
                                    FROM `examinations`
                                    WHERE HOUR(start_time) >= '08' AND HOUR(end_time) <= '11'
                                    GROUP BY MODULE ORDER BY MORNING_SESSION ASC LIMIT 10");
        $row->execute();
        return $row->fetchAll(PDO::FETCH_OBJ);
    }

}

?>
