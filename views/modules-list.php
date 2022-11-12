<?php
	include("topHeader.php");
	$rows = $module->getAllModules();
?>

<div class="container">
	
	<div class="row">
		<div class="col-md-12">
			<h3 class="mt-4 text-light"><i class="fa fa-book"></i> Total Modules</h3><hr>

			<div class="card">
				<div class="card-body">
					<div>
						<input type="search" class="form-control" style="width:550px" name="search" id="search" placeholder="search by module code or name" autofocus>

						<a href="?action=lecturer-home" class="btn btn-dark float-right" style="margin-top: -38px"><i class="fa fa-chevron-left"></i> Back</a>
					</div>
					<hr>
					<table class="table table-bordered table-striped">
						<thead class="table-danger text-dark">
							<th>Module Code</th><th>Module Name</th>
						</thead>
						<tbody id="results">
							<?php foreach($rows as $row): ?>
							<tr>
								<td><?php echo $row->module_code; ?></td>
								<td><?php echo $row->module_name; ?></td>
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
			$.get("index.php", {"action":"filter-modules", "searchby": searchText}, function(response) {
				$('#results').html(response);
			});
		});
	});
</script>