<?php
    if(!$student->is_logged_in()) {
        header("Location: ?action=login");
    }
    if(isset($_SESSION['stud-num'])) {
        $studentNumber = $_SESSION['stud-num'];
        $row = $student->getStudentInfo($studentNumber);
        $is_registered = $admission->is_student_registered($studentNumber);
        $registredModules = $admission->getAllStudentAdmission($studentNumber);
        $exams = $exam->getStudentComingExams($studentNumber);
        $countExams = ($exams != false) ? count($exams) : 0;
        $countModules = ($registredModules != false) ? count($registredModules) : 0;
    }
    include ("topHeader.php");
?>

<!-- Page Content -->
<div class="container">
    
    <div class="row">
        
        <?php include('views/sidebarmenu.php'); ?>

        <div class="col-lg-9">
            
            <div class="card mt-2">
                <div class="card-body">
                    <h4> Student Information</h4>
                    <hr>
                        <div class="row mt-4 mb-4">
                            <div class="col-md-6">
                                <div class="card bg-success text-light">
                                    <div class="card-body bg-green">
                                        <i class="text-light fa fa-graduation-cap fa-5x float-left"></i> 
                                        <span style="font-size:3em; position:absolute; right:15px; margin-top:20px;"><?php echo $countModules; ?></span> 
                                        <span class="float-right" style="font-size: 1.5em;">Registered Modules</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-info text-light">
                                    <div class="card-body bg-green">
                                        <i class="text-light fa fa-list-alt fa-5x float-left"></i> 
                                        <span style="font-size:3em; position:absolute; right:15px; margin-top:20px;"><?php echo $countExams; ?></span> 
                                        <div class="float-right" style="font-size: 1.5em;">Examinations</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table border="1" class="table table-striped">
                            <thead class="bg-secondary text-light"><th>Student Number</th><th>Firstname</th>
                            <th>Lastname</th><th>Email</th><th>Admission Status</th></thead>
                            <tr>
                                <td><?php echo $row->student_number; ?></td>
                                <td><?php echo $row->student_name; ?></td>
                                <td><?php echo $row->student_surname; ?></td>
                                <td><?php echo $row->student_email; ?></td>
                                <td><?php echo ($is_registered==true) ? 'Registered' : 'Not Registred' ; ?></td>
                            </tr>
                        </table>
                </div>
            </div>

        </div>
        
        <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->


<?php include ("footer.php"); ?>