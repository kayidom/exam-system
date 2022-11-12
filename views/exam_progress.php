<?php

if(isset($_REQUEST['start'])) {
    $_SESSION['start'] = 'yes';
    $examInfo = $exam->getExamInfo($_REQUEST['exam']);
    
    $examStartTime = new DateTime($examInfo->StartTime);
    $examEndTime = new DateTime($examInfo->UploadTime);

    $interval = date_diff($examStartTime, $examEndTime);
    $hrs = $interval->format("%H");
    $min = $interval->format("%i");

}
elseif(isset($_SESSION['start'])) {
    $finishTime = null;
    echo "<script>window.open('?action=start-exam&start=yes&exam=".$_REQUEST['exam']."', '_self')</script>";
}
else {
    $finishTime = null;
}

include("topHeader.php");

?>

<div class="container">
    <div class="row">
            
        <?php include('views/sidebarmenu.php'); ?>

        <div class="col-lg-9">
            <div class="card mt-2">
                <div class="card-body">

                <?php if(isset($_REQUEST['start'])) { ?>

                <h4 class="mb-3 text-primary">
                    <i class="fa fa-clock-o"></i> Time Left: <span id="timer">0:0:0</span>
                </h4>
                <h4>
                    <span class="text-center">Examination Inprogress</span> 
                    <span class="float-right badge badge-info">Total Questions: <?php echo $examInfo->number_of_questions; ?></span>
                </h4>
                <hr>

                <div class="mt-3">
                    <form action="" id="exam-form" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <div id="nameOfpaper"><?php echo $examInfo->file_document; ?>
                            <a href="exams/<?php echo $examInfo->file_document; ?>" class="btn btn-sm btn-primary"><i class="fa fa-download"></i> Download Exam Paper</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-muted mb-3">Upload your exam answers document here:</label><br>
                            <input type="hidden" name="exam_date" value="<?php echo $examInfo->exam_date; ?>">
                            <input type="hidden" name="studentNumber" value="<?php echo $_SESSION["stud-num"]; ?>">
                            <input type="file" name="filename" class="form-control mb-2" id="filename"/>
                            <button type="submit" class="btn btn-success uploadFile" name="action" value="exam-submit">
                                <i class="fa fa-upload"></i> Upload file</button><br>
                            <small class="text-danger">Allowed to upload 1 file, allowed file types are PDF and DOCX<small>
                        </div>
                    <form>
                <div>
                    
                <?php } else { ?>
                    <h4>Student Declaration</h4><hr>
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="GET" enctype="application/x-www-forms-urlencoded">
                                <div class="from-group">
                                    I declare that i have been honest <span class="text-danger">*</span>
                                </div>
                                <div class="from-group">
                                    <input type="radio" class="mt-3" name="declaration" value="yes"> Yes
                                </div>
                                <div class="from-group">
                                    <input type="radio" class="mt-3" name="declaration" value="no"> No
                                </div>
                                <div class="from-group mt-4 text-center">
                                    <a href="?action=student-exams&viewexam=<?php echo $_REQUEST['exam']; ?>" class="btn btn-md btn-primary">&larr; Back</a>
                                    <button type="button" class="btn btn-md btn-success continue" name="action" value="begin" >Start Exam &rarr;</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>

                <div>
            </div>
        </div>

    </div>
</div>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">

function _(id) {
    return document.querySelector(id);
}


//initialize exam time Hours and Minutes variable with values
    var hours = <?php echo $hrs; ?>;
    var minutes = <?php echo $min; ?>;
    var seconds = 60;
    //function to check time and run count down timer
    var countTimer = function() {
        seconds--;
        if(seconds == -1) {
            seconds = 59;
            if(minutes <= 0) {
                if(hours != 0) {
                    hours--;
                    minutes = 59;
                }
                if(hours <= 0 && minutes <= 0) {
                    minutes = 0;
                }
            }
            else {
                minutes--;
            }
        }
        //update timer counter on screen
        $('#timer').html(formatTime(hours) + ':' + formatTime(minutes) +':'+ formatTime(seconds));
        stopTimer(hours, minutes, seconds); //check for value to count
    }

    //update count down timer interval
    var timer = setInterval(countTimer, 1300);
    
    //function to terminate on timer finished
    function stopTimer(hrs, mins, secs) {
        if(hrs <= 0 && mins <= 0 && secs <= 0) {
            clearInterval(timer);
            // alert('timer finished');

            $('<input type="hidden" name="autosubmit" value="true" placeholder="temporary element">').insertBefore('#submit');

            
            $('#submit').click();

            $('input[type="radio"]').attr('disabled', true);
            // $('#submit').attr('disabled', true);

            $('#message').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> Your examination time has ended.</div>');
            return false;
        }
    }

function formatTime(time) {
    return time < 10 ? `0${time}` : time;
}


function validateOption() {
    alert('test');
    //var selectedOption = document.forms[0].declaration.value;
    //let modCode = "BSM1501"; //"<?php //echo $_REQUEST['exam']; ?>";

    /*if(selectedOption == "") {
        alert("Please select declaration");
    }
    else if(selectedOption == "no") {
        var actionConfirm = confirm("Please note you won't proceeed to the exam test");
        if(actionConfirm == false) {
            return false;
        }
        else {
            //redirect user back to previous page
            window.open("?action=student-exams&viewexam="+modCode, '_self');
        }
    }
    else {
        //continue with examination after declaration
        window.open("?action=start-exam&start="+selectedOption+"&exam="+modCode, '_self');
    }*/
}

$_('.uploadFile').addEventListener('click',function() {
    alert('test');
});

_('.uploadFile').addEventListener('click', function(e) {
    if(_('#filename').value == '') {
        e.preventDefault();
        alert('Please upload file first');
        _('#filename').style.borderColor = "#ff0000";
        return false;
    }
    else {
        _('#filename').style.borderColor = "transparent";
        //send form for uploading and finish exam
        _('#exam-form').submit();
        // end-exam
    }
});

</script>