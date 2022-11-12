<?php
    if(isset($_SESSION['start'])) {
        unset($_SESSION['start']);
    }
    include("topHeader.php");
?>

<div class="container">
    <div class="row">
            
        <?php include('views/sidebarmenu.php'); ?>

        <div class="col-lg-9">
            <div class="card mt-2">
                <div class="card-body">
                    <h1 class="text-success">THANK YOU</h1>
                    <p>Thank you for your examination document will now be uploaded and saved to Online Exam Portal.</p>
                    <a href="?action=student-home" class="btn btn-lg btn-success mt-3"><i class="fa fa-check"></i> FINISH</a>
                </div>
            </div>
        </div>
    </div>
</div>