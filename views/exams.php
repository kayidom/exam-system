<?php

    /*if(!$student->is_logged_in()) {
        header("Location: ?action=login");
    }*/
    


    if(isset($_SESSION['user_name'])) {
        $studentNumber = $_SESSION['user_name'];
        $rows = $exam->getStudentComingExams($studentNumber);
        $examsCount = ($rows != false) ? count($rows) : 0;
        $examsList = $exam->getStudentComingExams($studentNumber);
    }
    if(isset($_REQUEST['viewexam'])) {
        $examInfo = $exam->getExamInfo($_REQUEST['viewexam']);
    }

   // include("topHeader.php");

?>

<br><br>
<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

<!-- <div class="container">
    <div class="row"> -->
            
        <?php //include('views/sidebarmenu.php'); ?>

       
            <div class="card mt-2">
                <div class="card-body">
                    <h1 class="page-header">Exams Information <span class="float-right badge badge-info">Total Exams <?php echo $examsCount; ?></span></h1>




                 <!--   <h4> Exams Information <span class="float-right badge badge-info">Total Exams <?php //echo $examsCount; ?></span></h4> -->
                    <hr>
                    <div class="row">
                    <?php
                    if(!isset($_REQUEST['viewexam'])) {
                        if($examsList != false) {
                            foreach($examsList as $row) :
                                $data = $exam->getExamInfo($row->ModCode);
                                $rec = $module->getModuleByCode($row->ModCode);

                                $beginTime = new DateTime($data->StartTime);
                                $endTime = new DateTime($data->UploadTime);
                                $interval = $beginTime->diff($endTime);
                    ?>
                            <div class="col-md-4 mb-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <div class="text-info mb-3"><i class="fa fa-pencil-square fa-4x"></i></div>
                                        <div style="font-size: 1.2em;"><?php echo $row->ModCode; ?></div>
                                        <div class="mt-2"><?php echo $rec->Description; ?></div>
                                    </div>
                                    <div class="card-footer bg-light text-center">
                                        <a href="?action=student-exams&viewexam=<?php echo $row->ModCode; ?>">Show Details &rarr;</a>
                                    </div>
                                </div>
                            </div>
                    <?php
                            endforeach;
                        }
                        else {
                            echo "<div class='col-md-12 mb-4'><div class='alert alert-info text-center'>No available exams yet</div></div>";
                        }
                    } else {
                    ?>
                        <div class="col-md-12">
                        <div class="card bg-light">
                                <div class="card-body">
                                    <?php 
                                        //show list of exams here with link at right to start, 
                                        //at bottom show date and time
                                        $beginTime = new DateTime($examInfo->StartTime);
                                        $endTime = new DateTime($examInfo->UploadTime);
                                        $interval = $beginTime->diff($endTime);
                                        $isActive = ($examInfo->DateExam != date('Y-m-d') ) ? 'disabled' : null;
                                    ?>
                                    <table border="1" class="table table-striped">
                                        <tr>
                                            <td>Module Code: </td><td><?php echo $examInfo->ModCode; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Exam Date: </td><td><?php echo date('d F Y', strtotime($examInfo->DateExam)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Start Time: </td><td><?php echo date('H:i A', strtotime($examInfo->StartTime)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>End Time: </td><td><?php echo date('H:i A', strtotime($examInfo->UploadTime)); ?></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Exam Type: </td><td><?php #echo $examInfo->exam_type; ?></td>
                                        </tr> -->
                                       <!--  <tr>
                                            <td>Num Of Questions: </td><td><?php #echo $examInfo->number_of_questions; ?></td>
                                        </tr> -->
                                        <tr>
                                            <td>Duration: </td><td><?php echo $interval->format("%H:%I Hour(s)/Minutes"); ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="card-footer bg-light text-center">
                                    <a href="?action=student-exams" class="btn btn-md btn-primary">&larr; Back</a> 
                                    <a href="?action=start-exam&exam=<?php echo $examInfo->ModCode; ?>"  class="btn btn-md btn-success <?php echo $isActive; ?>">Take Exam &rarr;</a>
                                </div>
                            </div>
                        </div>
                <?php } ?>
                    </div>
                </div>
            </div>
        </div>

</div>