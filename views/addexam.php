<?php

$records = $exam->getAllExamRecords();
asort($records);
$modules = $module->getAllModules();

?>

<!-- Page Content -->
<div class="container">

    <div class="row mb-2">

        <div class="col-lg-12">

            <h4 class="mt-2 text-light"><i class="fa fa-pencil"></i> Exams 
                <?php if(isset($_REQUEST['edit']) || isset($_REQUEST['add'])) { ?>
                <a href="?action=list-exams" class="btn btn-warning float-right mr-3"><i class="fa fa-arrow-left"></i> List Exams</a>
                <?php } ?>
            </h4><hr>

            <div class="card h-85 mt-1">
                <div class="card-body">

                        <div>
                            <div class="lead">Add/Edit New Examination</div><hr>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
                                    <select class="form-control" name="module_code">
                                        <option value="">Select Module</option>
                                        <?php foreach($modules as $data): 
                                            $selected = ($data->module_code==$module_code) ? 'selected' : '';
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $data->module_code; ?>">
                                            <?php echo $data->module_code.' - '.$data->module_name; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <select class="form-control" name="exam_type">
                                        <option value="">Select Exam Type</option>
                                        <option value="upload">Upload</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="exam_date" placeholder="" value="<?php echo $exam_date; ?>">
                                </div>
                                <div class="mb-3">
                                    <input type="time" class="form-control" name="start_time" placeholder="" value="<?php echo $start_time; ?>">
                                </div>
                                <div class="mb-3">
                                    <input type="time" class="form-control" name="end_time" placeholder="" value="<?php echo $end_time; ?>">
                                </div>
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="document_file" accept=".pdf" required>
                                    <small class="text-muted">**Only PDF Documents allowed.</small>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-success" name="action" value="exam-add">Add Exam</button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
            <br>
        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<script src="assets/js/jquery-3.6.js"></script>
<script src="assets/js/jquery-1.12.4.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/datatables/datatables.min.js"></script>
<?php # include ("footer.php"); ?>

<script type="text/javascript">
    $(function() {

        $('#dt_table').DataTable();

         $('#updateImage').on('show.bs.modal', function(event) {
            var eventAction = $(event.relatedTarget)
            var examID = eventAction.data('examid');
            var jobDate = eventAction.data('date');
            $('#examID').val(examID);
            $('#jobDate').val(jobDate);
        });
    })
</script>