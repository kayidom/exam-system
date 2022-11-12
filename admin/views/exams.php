<?php

    if(!$student->is_logged_in()) {
        header("Location: ?action=login");
    }
    if(isset($_SESSION['stud-num'])) {
        $studentNumber = $_SESSION['stud-num'];
        $rows = $exam->getStudentComingExams($studentNumber);
        $examsCount = ($rows != false) ? count($rows) : 0;
        $examsList = $exam->getStudentComingExams($studentNumber);
    }
    if(isset($_REQUEST['viewexam'])) {
        $examInfo = $exam->getExamInfo($_REQUEST['viewexam']);
    }

    include("topHeader.php");

?>

<div class="container">
    <div class="row">
            
        <?php include('views/sidebarmenu.php'); ?>

        <div class="col-lg-9">
            <div class="card mt-2">
                <div class="card-body">
                    <h4> Exams Information <span class="float-right badge badge-info">Total Exams <?php echo $examsCount; ?></span></h4>
                    <hr>
                    <div class="row">
                    <?php
                    if(!isset($_REQUEST['viewexam'])) {
                        if($examsList != false) {
                            foreach($examsList as $row) :
                                $data = $exam->getExamInfo($row->module_code);
                                $rec = $module->getModuleByCode($row->module_code);

                                $beginTime = new DateTime($data->start_time);
                                $endTime = new DateTime($data->end_time);
                                $interval = $beginTime->diff($endTime);
                    ?>
                            <div class="col-md-4 mb-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <div class="text-info mb-3"><i class="fa fa-pencil-square fa-4x"></i></div>
                                        <div style="font-size: 1.2em;"><?php echo $row->module_code; ?></div>
                                        <div class="mt-2"><?php echo $rec->module_name; ?></div>
                                    </div>
                                    <div class="card-footer bg-light text-center">
                                        <a href="?action=student-exams&viewexam=<?php echo $row->module_code; ?>">Show Details &rarr;</a>
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
                                        $beginTime = new DateTime($examInfo->start_time);
                                        $endTime = new DateTime($examInfo->end_time);
                                        $interval = $beginTime->diff($endTime);
                                        $isActive = ($examInfo->exam_date != date('Y-m-d') ) ? 'disabled' : null;
                                    ?>
                                    <table border="1" class="table table-striped">
                                        <tr>
                                            <td>Module Code: </td><td><?php echo $examInfo->module_code; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Exam Date: </td><td><?php echo date('d F Y', strtotime($examInfo->exam_date)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Start Time: </td><td><?php echo date('H:i A', strtotime($examInfo->start_time)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>End Time: </td><td><?php echo date('H:i A', strtotime($examInfo->end_time)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Exam Type: </td><td><?php echo $examInfo->exam_type; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Num Of Questions: </td><td><?php echo $examInfo->number_of_questions; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Duration: </td><td><?php echo $interval->format("%H:%I Hour(s)/Minutes"); ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="card-footer bg-light text-center">
                                    <a href="?action=student-exams" class="btn btn-md btn-primary">&larr; Back</a> 
                                    <a href="?action=start-exam&exam=<?php echo $examInfo->module_code; ?>"  class="btn btn-md btn-success <?php echo $isActive; ?>">Take Exam &rarr;</a>
                                </div>
                            </div>
                        </div>
                <?php } ?>
                    </div>
                </div>
            </div>
        </div>

</div>