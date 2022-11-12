
<?php include("topHeader.php");
    
    $totalAdmission = $admission->getAllAdmissions();
    $totalStudent = $student->getAllStudents();
    $totalModules = $module->getAllModules();
    $totalExams = $exam->getAllExamRecords();

    $reportSummary = $reports->summaryReportStudentModuleAdmission();
    $reportTrend = $reports->trendWeeklyReport();

?>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h4 class="mt-2 text-light"><i class="fa fa-dashboard"></i> Lecture Dashboard</h4><hr>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-3">
            <div class="card h-100 mt-1 bg-primary" onclick="open_page('?action=admissions-list')" style="cursor: pointer;">
                <div class="card-body text-right text-light">
                    <i class="fa fa-clipboard fa-4x float-left"></i>
                    <div style="font-size: 2em;"><?php echo count($totalAdmission); ?></div>
                    <div style="font-size: 1.5em;" class="mt-4">Total Admissions</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card h-100 mt-1 bg-info" onclick="open_page('?action=students-list')" style="cursor: pointer;">
                <div class="card-body text-right text-light">
                    <i class="fa fa-graduation-cap fa-4x float-left"></i>
                    <div style="font-size: 2em;"><?php echo count($totalStudent); ?></div>
                    <div style="font-size: 1.5em;" class="mt-4">Total Students</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card h-100 mt-1 bg-success" onclick="open_page('?action=modules-list')" style="cursor: pointer;">
                <div class="card-body text-right text-light">
                    <i class="fa fa-book fa-4x float-left"></i>
                    <div style="font-size: 2em;"><?php echo count($totalModules); ?></div>
                    <div style="font-size: 1.5em;" class="mt-4">Total Modules</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card h-100 mt-1 bg-warning" onclick="open_page('?action=list-exams')" style="cursor: pointer;">
                <div class="card-body text-right text-light">
                    <i class="fa fa-desktop fa-4x float-left"></i>
                    <div style="font-size: 2em;"><?php echo count($totalExams); ?></div>
                    <div style="font-size: 1.5em;" class="mt-4">Total Exams</div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->

    <div class="row mb-5">

        <div class="col-lg-6">
            <div class="card h-100 mt-1">
                <div class="card-body">
                    <canvas id="myBarChart" width="100px" height="80px"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100 mt-1">
                <div class="card-body">
                    <canvas id="myDonutChart" width="100px" height="80px"></canvas>
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
    function open_page(url) {
        window.location.href = url;
    }

    function BarChart() {
        var items = <?php echo json_encode($reportSummary); ?>;
        var labels = []; //create empty array to hold string names
        var matrices = []; //empty array to hold values
        for(item in items) {
            labels.push(items[item].MODULE);
            matrices.push(items[item].TOTAL);
        }
        var ctx = document.getElementById("myBarChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Admission Total', //Name the series
                    data: matrices,
                    backgroundColor: [
                        "#FF6384", "#4BC0C0", "#FFCE56", "#36A2EB", "#8AC054", "#967ADA",
                        "#2196F3", "#F44336", "#3F51B5", "#009688", "#E7E9ED",
                    ],
                    borderColor: [ //adding custom color
                        "#FF6384", "#4BC0C0", "#FFCE56", "#36A2EB", "#8AC054", "#967ADA", "#E7E9ED"
                    ],
                    borderWidth: 0 //specify bar border
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Summary Report - Student Per Module Admission'
                },
                responsive: true, //Instruct ChartJs to respond nicely
                maintainAspectRatio: true, //Add to prevent default behaviour of full width/height
            }
        });
    }
    BarChart(); //call function do display Bar Chart



    function doughnutChart() {
        var dataList = <?php echo json_encode($reportTrend); ?>;
        var labels = [];
        var data = [];
        dataList.forEach(function(param) {
            labels.push(param.DAYS);
            data.push(param.TOTAL);
        });
        var ctx = document.getElementById("myDonutChart").getContext('2d');
        var myChart = new Chart(ctx, { 
            type: 'doughnut', 
            data: { 
                labels: labels, //["Tokyo", "Mumbai", "Mexico City", "Shanghai"], 
                datasets: [{
                    data: data, //[500, 50, 2424, 14040], // Specify the data values array 
                    backgroundColor: ['#2196f3', '#f44336', '#3f51b5', '#009688','#FF6384', '#4BC0C0', '#FFCE56', '#36A2EB', '#8AC054', '#967ADA'], // Add custom color background (Points and Fill) 
                    borderColor: ['#2196f3', '#f44336', '#3f51b5', '#009688','#2196f3', '#f44336', '#3f51b5', '#009688', '#3f51b5', '#009688'], // Add custom color border
                    borderWidth: 0 // Specify bar border width 
                }]
            }, 
            options: {
                title: {
                    display: true,
                    text: 'Trend Report - Weekly Submissions'
                },
                responsive: true, // Instruct chart js to respond nicely. 
                maintainAspectRatio: true, // Add to prevent default behaviour of full-width/height 
            }
        });
    } doughnutChart();

</script>