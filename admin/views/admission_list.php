<?php

if(!isset($_SESSION['admin'])) {
    header("Location: ?action=login");
}

include ("topHeader.php");

if(isset($_REQUEST['show_admission'])) {
	$studentNumber = $_REQUEST['show_admission'];
	$studInfo = $student->getStudentInfo($studentNumber);
	$admission_details = $admission->getAllStudentAdmission($studentNumber);
	$totalCount = ($admission_details != false) ? count($admission_details) : 0;
}

// $admitted = $admission->getAllAdmissions();
$registration = $student->getStudentRegistration();

?>

<!-- Page Content -->
<div class="container">

    <div class="row mb-2">

        <div class="col-lg-12">

        	<h4 class="mt-2 text-light"><i class="fa fa-clipboard"></i> Admission List</h4><hr>

        	<div class="card h-85 mt-1">
                <div class="card-body">
	            <?php if(!isset($_REQUEST['show_admission'])) { ?>
                	<form action="" method="POST" enctype="">
	                	<a href="?action=lecturer-home" class="btn btn-dark float-right"><i class="fa fa-home"></i> Home</a>
                		<div class="mb-2">
		                	<input type="search" class="form-control" style="width:550px" name="search" id="search" placeholder="search by student names or number" autofocus>
                		</div>
	                </form>
                	<table class="table table-bordered">
                		<thead>
                			<th>Student Number</th>
                			<th>Student Fullnames</th>
                			<th>Student Email</th>
                			<th><div class="badge badge-danger">Admissions: <?php echo count($registration); ?></div></th>
                		</thead>
                		<tbody id="results">
                			<?php foreach($registration as $rec): ?>
                			<tr>
                				<td><?php echo $rec->student_number; ?></td>
                				<td><?php echo $rec->student_name.' '.$rec->student_surname; ?></td>
                				<td><?php echo $rec->student_email; ?></td>
                				<td><a href="?action=admissions-list&show_admission=<?php echo $rec->student_number; ?>" class="btn btn-primary">Show</a></td>
                			</tr>
	                		<?php endforeach; ?>
                		</tbody>
                	</table>
		        <?php } else { ?>

		        	<table class="table table-bordered">
		        		<div>Student Name: <?php echo $studInfo->student_name." ".$studInfo->student_surname; ?>
			        		<span class="badge badge-primary float-right">Registered Modules: <?php echo $totalCount; ?></span>
		        		</div>
		        			
		        		<thead>
		        			<th>Module Code</th><th>Module Name</th>
		        		</thead>
		        		<tbody>
		        			<?php if($admission_details != false) { ?>
		        			<?php foreach($admission_details as $row):
		        				$data = $module->getModuleByCode($row->module_code);
		        				if($data != false) {
		        				?>
		        			<tr>
		        				<td><?php echo $data->module_code; ?></td>
		        				<td><?php echo $data->module_name; ?></td>
		        			</tr>
			        		<?php } else { ?>
			        			<tr><td colspan="2"><div class="alert alert-info"><i class="fa fa-exclamation"></i> Module: <?php echo $row->module_code; ?> information was not found.</div></td></tr>
			        		<?php }  ?>
			        		<?php endforeach; ?>
			        		<?php } else { ?>
			        			<tr><td colspan="2"><div class="alert alert-info"><i class="fa fa-exclamation"></i> No modules registered</div></td></tr>
		        			<?php } ?>
		        		</tbody>
		        	</table>
		        	<a href="?action=admissions-list" class="btn btn-dark float-right"><i class="fa fa-chevron-left"></i> Back</a>
				<?php } ?>
                </div>
            </div>




        </div>

    </div>

</div>

<script src="assets/vendor/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(function() {
		$('#search').on('keyup', function() {
			var searchText = $(this).val().trim();
			if(searchText.length <= 1) {
				return false;
			}
			$.get("index.php", {"action":"search-student", "searchby": searchText}, function(response) {
				$('#results').html(response);
			});
		});
	});
</script>