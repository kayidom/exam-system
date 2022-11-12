<?php

include("check.php");
include("header.php");
//include("connection.php");
?>


<?php


//session_start();

require_once("models/database.php");
require_once("models/adminModel.php");
require_once("models/studentsModel.php");
require_once("models/admissionModel.php");
require_once("models/modulesModel.php");
require_once("models/examsModel.php");
require_once("models/reportsModel.php");

$lecture = new Lecture();
$student = new Student();
$admission = new Admission();
$exam = new Exams();
$module = new Modules();
$reports = new Reports();

$action = null;

if(isset($_REQUEST['action'])) {

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $action = filter_input(INPUT_GET, "action");
    }
    else {
        //get the request
        $action = filter_input(INPUT_POST, "action");
    }


    if($action == "addexam") {
        include("views/addexam.php");
    }

    //
    if($action == "exam-add") {

        $data = array(
            'ModCode' => $_REQUEST['ModCode'],
            'StartTime' => $_REQUEST['StartTime'],
            'UploadTime' => $_REQUEST['UploadTime'],
            'DateExam' => $_REQUEST['DateExam'],
            'AnswerPaperPDF' => $_REQUEST['document_file'],
        );

        if(in_array('', $data)) {
            echo "<script>alert('Please type all required data.')</script>";
            include("views/addexam.php");
            exit();
        }

        // print_r($data);
        // exit();

        $dir_path = "exams";
        $student_dir = "submissions";

        if(!is_dir($dir_path)) {
            mkdir($dir_path);
            mkdir($student_dir);
        }

        $filename = $_FILES['document_file']['name']; //collect the document file name

        $file_parts = explode('.', $filename); //separate document info in parts

        $file_ext = end($file_parts);

        //rewrite the document file name
        $filename = strtoupper($data['ModCode'])."_".$data['DateExam']."_Exam.".$file_ext;

        $targetPath = $dir_path."/".$filename;
        //Function to insert from data into database
        if($exam->insertExam($data, $filename)) {
        	//uploads file to a folder
            if(move_uploaded_file($_FILES['document_file']['tmp_name'], $targetPath)) {
                echo "<script>alert('New examination has been added.')</script>";
                echo "<script>alert('Document '".$filename."' has been uploaded.'')</script>";
            }
            else {
                echo "<script>//alert('Sorry failed to upload document.')</script>";
            }
        }
        //redirects back after saving
        echo "<script>//window.open('?action=addexam','_self')</script>";
        include("views/select.php?action=addexam"); 
        exit();
    }

}

exit();


   