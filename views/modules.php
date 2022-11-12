
<?php
    // if(!$student->is_logged_in()) {
       //  header("Location: ?action=login");
     //}

    $module = new Modules();

     if(isset($_SESSION['user_name'])) {
        $studentNumber = $_SESSION['user_name'];
        $registered = $admission->getAllStudentAdmission($studentNumber);
        $countModules = ($registered != false) ? count($registered) : 0;
     }

    //include ("topHeader.php");
    
?>

<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
<!-- <div class="container">
    <div class="row"> -->
            
            <?php// include('views/sidebarmenu.php'); ?>

         <!--   <div class="col-lg-9">  -->
                <div class="card mt-2">
                    <div class="card-body">
                        <h4> Modules Information <span class="float-right badge badge-info">Total Modules <?php echo $countModules; ?></span></h4>
                        <hr>
                        <div class="row">
                            
                            <?php if($registered != false) { ?>
                                <?php foreach($registered as $rec):
                                    $row = $module->getModuleByCode($rec->ModCode); 
                                ?>
                            <div class="col-md-4 mb-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <div class="text-info mb-3"><i class="fa fa-book fa-3x"></i></div>
                                        <div style="font-size: 1.2em;"><?php echo $row->ModCode; ?></div>
                                        <div class="mt-2"><?php echo $row->Description; ?></div>
                                    </div>
                                    <div class="card-footer bg-light text-center"><a href="?action=student-exams&module=<?php echo $row->ModCode; ?>">View &rarr;</a></div>
                                </div>
                            </div>
                                <?php endforeach; ?>
                            <?php } else { ?>
                            <div class='col-md-12'>
                                <div class='alert alert-info text-center'><i class="fa fa-exclamation"></i> You did not register for any modules yet.</div>
                            </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<?php #include ("footer.php"); ?>