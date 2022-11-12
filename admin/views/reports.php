
<?php include ("topHeader.php"); ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-12">

            <h4 class="mt-2 text-light"><i class="fa fa-line-chart"></i> MIS Reports</h4><hr>

            <div class="card h-100 mt-1">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <canvas id="myLineChart" width="100%" height="45px"></canvas>
                        </div>
                    </div>

                    <br><hr>

                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <caption>Summary Report - Students Admitted Per Module</caption>
                            <table class="table table-bordered table-striped">
                                <tr class="table-danger text-danger"><th>Modules</th><th>Total Students</th></tr>
                                <?php foreach($reports->summaryReportStudentModuleAdmission() as $row): ?>
                                    <tr>
                                        <td><?php echo $row->MODULE; ?></td>
                                        <td><?php echo $row->TOTAL; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>

                        <div class="col-md-6 mt-3">
                            <caption>Predictive Report - Submission Future Predictions</caption>
                            <table class="table table-bordered table-striped">
                                <tr class="table-danger text-danger"><th>Months</th><th>Total Submissions</th></tr>
                                <?php foreach($reports->predictiveReportSubmissions() as $row): ?>
                                    <tr>
                                        <td><?php echo $row->MONTH; ?></td>
                                        <td><?php echo $row->SUBMITTED; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <caption>Trend Report - Weekly Submissions</caption>
                            <table class="table table-bordered table-striped">
                                <tr class="table-danger text-danger"><th>Weekdays</th><th>Total Submissions</th></tr>
                                <?php foreach($reports->trendWeeklyReport() as $row): ?>
                                    <tr>
                                        <td><?php echo $row->DAYS; ?></td>
                                        <td><?php echo $row->TOTAL; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <caption>Trend Report - Submissions Times</caption>
                            <table class="table table-bordered table-striped">
                                <tr class="table-danger text-danger"><th>Module</th><th>Exam Times</th></tr>
                                <?php foreach($reports->trendReportSession() as $row): ?>
                                    <tr>
                                        <td><?php echo $row->MODULE; ?></td>
                                        <td><?php echo date('H:i A', strtotime($row->MORNING_SESSION)); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/Chart.min.js"></script>


<script type="text/javascript">
    function showLineChart() {
        var items = <?php echo json_encode($reports->predictiveReportSubmissions()); ?>;
        var labels = []; //create empty array to hold string names
        var matrices = []; //empty array to hold values
        for(item in items) {
            labels.push(items[item].MONTH);
            matrices.push(items[item].SUBMITTED);
        }
        var ctx = document.getElementById("myLineChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Submission', //Name the series
                    data: matrices,
                    fill: false,
                    backgroundColor: [ "#f44336" ],
                    borderColor: [ "#f44336" ],
                    borderWidth: 1 //specify bar border
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Predictive Report - Submission Future Predictions'
                },
                responsive: true, //Instruct ChartJs to respond nicely
                maintainAspectRatio: true, //Add to prevent default behaviour of full width/height
            }
        });
    }
    showLineChart(); //call function do display Bar Chart
</script>