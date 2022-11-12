<?php
include("check.php");

//session_start();
//include("connect.php");
include("header.php");

require_once("models/database.php");
//require_once("models/adminModel.php");
require_once("models/studentsModel.php");
require_once("models/admissionModel.php");
require_once("models/modulesModel.php");
require_once("models/examsModel.php");
//require_once("models/reportsModel.php");




// $student = new Student();
$admission = new Admission();
$exam = new Exams();
$module = new Modules();




if(isset($_REQUEST['action'])) {

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $action = filter_input(INPUT_GET, "action");
    }
    else {
        //get the request
        $action = filter_input(INPUT_POST, "action");
    }

     //processing the above reqeust



 if($action == "student-modules") {
        include("views/modules.php");
    }
    elseif($action == "student-exams") {
        include("views/exams.php");
    }
    elseif($action == "start-exam") {
        include("views/exam_progress.php");
    }
    elseif($action == "exam-submit") {
        $DIR_PATH = "submissions"; //folder name

        $moduleCode = $_REQUEST['exam']; //module code

        $filename = $_FILES['filename']['name']; //file name to be uploaded

        $file_parts = explode('.', $filename); //separate document info in parts

        $file_ext = end($file_parts);

        //rewrite the document file name
        $filename = $_REQUEST['studentNumber']."_".$moduleCode."_".$_REQUEST['exam_date'].'.'.$file_ext;
        //directory full path for upload
        $targetPath = $DIR_PATH."/".$filename;

        if(!is_dir($DIR_PATH)) { //if directory does not exists
            mkdir($DIR_PATH); //else create the directory
        }
        if($exam->studentExamSubmission($_REQUEST['studentNumber'], $moduleCode, $filename)) {
            if(move_uploaded_file($_FILES['filename']['tmp_name'], $targetPath)) { //move file for upload
                echo "<script>alert('Your examination document has been submitted.')</script>"; //success message
                echo "<script>alert('Document: '".$filename."' has been uploaded.'')</script>";
            }
            else {
                echo "<script>alert('Failed to upload document: ".$filename."')</script>"; //error message on upload fail
            }
        }
        else {
            echo "<script>alert('Failed to submit your exam, please try again.')</script>"; //error message of fail to save
        }
        echo "<script>window.open('?action=end-exam','_self')</script>"; //redirect to page
    }
    elseif($action == "end-exam") {
        include("views/exam_end.php");
    }
}

















?>




































    
    	<!-- <form  method="POST" action="examination.php" >

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                           <h3 style="margin-top: 5%;">Start Examination</h3> 
                        </div>-->
                        
                    
                   <!--  </div> -->
                    <!-- /.row 
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                         <p class="text-center">Hello Students, <span class="text-danger">Are you ready for the examination ?</span> Let's start here!</p>
                    <input type="hidden" id="sem" value="<?php //echo $_SESSION['user_sem']; ?>">

                    <input type="hidden" id="branch" value="<?php //echo $_SESSION['user_branch']; ?>">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label >Subject </label>
                        
                            <select name="subject" class="form-control" id="subject" required>
                                <option value="">-- Select Subject --</option>
                            </select>
                        </div>
                    </div>

                     <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-default">Next</button>
                    </div>

                </div>
                                           </form>         
                                        </div>
                                       
                                    </div>
                                  
                                </div>
                               
                            </div> -->
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
            <?php
            include("footer.php");
            ?>
                                 
  



</script>