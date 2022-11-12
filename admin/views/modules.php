
<?php
    if(!$student->is_logged_in()) {
        header("Location: ?action=login");
    }
    if(isset($_SESSION['stud-num'])) {
        $studentNumber = $_SESSION['stud-num'];
        $registered = $admission->getAllStudentAdmission($studentNumber);
        $countModules = ($registered != false) ? count($registered) : 0;
    }

    include ("topHeader.php");
    
?>

<div class="container">
    <div class="row">
            
            <?php include('views/sidebarmenu.php'); ?>

            <div class="col-lg-9">
                <div class="card mt-2">
                    <div class="card-body">
                        <h4> Modules Information <span class="float-right badge badge-info">Total Modules <?php echo $countModules; ?></span></h4>
                        <hr>
                        <div class="row">
                            
                            <?php if($registered != false) { ?>
                                <?php foreach($registered as $rec):
                                    $row = $module->getModuleByCode($rec->module_code); 
                                ?>
                            <div class="col-md-4 mb-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <div class="text-info mb-3"><i class="fa fa-book fa-3x"></i></div>
                                        <div style="font-size: 1.2em;"><?php echo $row->module_code; ?></div>
                                        <div class="mt-2"><?php echo $row->module_name; ?></div>
                                    </div>
                                    <div class="card-footer bg-light text-center"><a href="">View &rarr;</a></div>
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