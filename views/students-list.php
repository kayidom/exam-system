<?php
	include("topHeader.php");
	$rows = $student->getAllStudents();
?>

<div class="container">
	
	<div class="row">
		<div class="col-md-12">
			<h3 class="mt-4 text-light"><i class="fa fa-graduation-cap"></i> Total Students</h3><hr>

			<div class="card">
				<div class="card-body">
					<div>
						<input type="search" class="form-control" style="width:550px" name="search" id="search" placeholder="search by student names or number" autofocus>

						<a href="?action=lecturer-home" class="btn btn-dark float-right" style="margin-top: -38px"><i class="fa fa-chevron-left"></i> Back</a>
					</div>
					<hr>
					<table class="table table-bordered table-striped">
						<thead class="table-danger text-dark">
							<th>Student Number</th><th>Name</th><th>Surname</th><th>Email</th>
						</thead>
						<tbody id="results">
							<?php foreach($rows as $row): ?>
							<tr>
								<td><?php echo $row->student_number; ?></td>
								<td><?php echo $row->student_name; ?></td>
								<td><?php echo $row->student_surname; ?></td>
								<td><?php echo $row->student_email; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
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
			$.get("index.php", {"action":"filter-student", "searchby": searchText}, function(response) {
				$('#results').html(response);
			});
		});
	});
</script>