<?php
include("check.php");
?>
<?php
include("connect.php");
include("header.php");


 // require_once("graphic_report.php"); 

$sql= "SELECT DISTINCT(ModCode) 'MODULE', COUNT(StudentNumber) AS 'TOTAL'
                                FROM `studentmodule` 
                                WHERE StudentNumber 
                                IN (SELECT StudentNumber FROM `studentinfo`)
                                GROUP BY MODULE HAVING TOTAL > 3";
$result=$conn->query($sql);



?>




<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">REPORTS</h1>



                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                  
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    
                                    <br>
                                    <div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <div class="col-sm-6">
        <div id="dataTables-example_filter" class="dataTables_filter">
            <h3>Summary Report - Students Admitted Per Module</h3>
            <thead>
                <tr>
                    <th>Modules</th>
                  
                    <th>Total Students</th>
                    
                </tr>
            </thead>
            <tbody>

<?php
foreach ($result as $row) {
	 
	?>
	<tr>
		<td><?php echo $row['MODULE']; ?></td>
       
		<td><?php echo $row['TOTAL']; ?></td>
		
		
		

	<!--	<td>	
            <a href="edituser.php?uid=<?php echo $row['uid']?>"><i class="fa fa-edit icon"></i></a><br><br>
          <a href="deleteuser.php?uid=<?php echo $row['uid']?>" onclick="return confirm('Are you sure to delete this record?')"> <i class="fa fa-trash icon"></i></a>
        </td>-->
        	</tr>
<?php	
}
?>
<?php 

$sql= "SELECT COUNT(TransactionID) 'TOTAL_COUNT',
                                    MONTHNAME(DateExam) 'EXAMS_SUBMISSIONS'
                                    FROM `exam_output`
                                    WHERE NULLIF(DateExam, '') IS NOT NULL
                                    GROUP BY EXAMS_SUBMISSIONS
                                    ORDER BY DateExam";
$result=$conn->query($sql);



?>





                                    <br>
                                    <div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <div class="col-sm-6">
        <div id="dataTables-example_filter" class="dataTables_filter">
            <h3>Predictive Report - Submission Future Predictions</h3>
            <thead>
                <tr>
                    <th>Total Exams</th>
                  
                    <th>Month</th>
                    
                </tr>
            </thead>
            <tbody>

<?php
foreach ($result as $row) {
     
    ?>
    <tr>
        <td><?php echo $row['TOTAL_COUNT']; ?></td>
       
        <td><?php echo $row['EXAMS_SUBMISSIONS']; ?></td>
        
        
        

    <!--    <td>    
            <a href="edituser.php?uid=<?php echo $row['uid']?>"><i class="fa fa-edit icon"></i></a><br><br>
          <a href="deleteuser.php?uid=<?php echo $row['uid']?>" onclick="return confirm('Are you sure to delete this record?')"> <i class="fa fa-trash icon"></i></a>
        </td>-->
            </tr>
<?php   
}
?>
<?php 
$sql= "SELECT COUNT(ModCode) 'COUNT', StudentNumber 'STUDENT', ModCode 'MODULE' FROM `studentmodule` GROUP BY MODULE HAVING COUNT(MODULE) >= 2;";
$result=$conn->query($sql);



?>





                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    
                                    <br>
                                    <div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <div class="col-sm-6">
        <div id="dataTables-example_filter" class="dataTables_filter">
            <h3>Trend Report - Submissions: records for students who enrolled more than one module</h3>
            <thead>
                <tr>
                    <th>Count</th>
                  
                    <th>Student</th>
                     <th>Module</th>
                    
                </tr>
            </thead>
            <tbody>

<?php
foreach ($result as $row) {
     
    ?>
    <tr>
        <td><?php echo $row['COUNT']; ?></td>
       
        <td><?php echo $row['STUDENT']; ?></td>
        <td><?php echo $row['MODULE']; ?></td>
        
        
        

    <!--    <td>    
            <a href="edituser.php?uid=<?php echo $row['uid']?>"><i class="fa fa-edit icon"></i></a><br><br>
          <a href="deleteuser.php?uid=<?php echo $row['uid']?>" onclick="return confirm('Are you sure to delete this record?')"> <i class="fa fa-trash icon"></i></a>
        </td>-->
            </tr>
<?php   
}
?>
<?php 

$sql= "SELECT COUNT(ModCode) 'TOTAL', DAYNAME(DateExam) 'DAYS' FROM `exam_output` GROUP BY DAYS ORDER BY `DAYS` DESC";
$result=$conn->query($sql);



?>



   <br>
                                    <div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <div class="col-sm-6">
        <div id="dataTables-example_filter" class="dataTables_filter">
            <h3>Trend Report - Weekly Submissions</h3>
            <thead>
                <tr>
                    <th> Total Submissions</th>
                  
                    <th>Weekdays</th>
                    
                </tr>
            </thead>
            <tbody>

<?php
foreach ($result as $row) {
     
    ?>
    <tr>
        <td><?php echo $row['TOTAL']; ?></td>
       
        <td><?php echo $row['DAYS']; ?></td>
        
        
        

    <!--    <td>    
            <a href="edituser.php?uid=<?php echo $row['uid']?>"><i class="fa fa-edit icon"></i></a><br><br>
          <a href="deleteuser.php?uid=<?php echo $row['uid']?>" onclick="return confirm('Are you sure to delete this record?')"> <i class="fa fa-trash icon"></i></a>
        </td>-->
            </tr>
<?php   
}
?>


























                                               
                                        </tbody>
        </div>
    </div>
</table>
                                    </div>
                                    <!-- /.table-responsive -->
                                    
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="../js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>



               <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>

    
</html>
<?php
include("footer.php");
?>
