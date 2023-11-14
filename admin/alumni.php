<?php include('db_connect.php'); ?>


<div class="container-fluid">

	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">

			</div>
		</div>

		</script>
		<div class="row">
			<div class="col-md-12">
				<div class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#add_alumni"> + New</div>
			</div>
		</div>
		<div class="row py-2">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List of Alumni</b>
						<!-- <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="index.php?page=manage_alumni" id="new_alumni">
					<i class="fa fa-plus"></i> New Entry
				</a></span> -->
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<!-- <colgroup>
								<col width="5%">
								<col width="10%">
								<col width="15%">
								<col width="15%">
								<col width="30%">
								<col width="15%">
							</colgroup> -->
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Avatar</th>
									<th class="">Name</th>
									<th class="">Course Graduated</th>
									<th class="">Status</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$alumni = $conn->query("SELECT a.*,c.course,Concat(a.lastname,', ',a.firstname,' ',a.middlename) as name from alumnus_bio a inner join courses c on c.id = a.course_id order by Concat(a.lastname,', ',a.firstname,' ',a.middlename) asc");
								while ($row = $alumni->fetch_assoc()) :

								?>
									<tr>
										<td class="text-center"><?php echo $i++ ?></td>
										<td class="text-center">
											<div class="avatar">
										
											<img src="assets/uploads/<?php echo trim($row['avatar'],"uploads/"); ?>" class="" alt="">
											</div>
										</td>
										<td class="">
											<p> <b><?php echo ucwords($row['name']) ?></b></p>
										</td>
										<td class="">
											<p> <b><?php echo $row['course'] ?></b></p>
										</td>
										<td class="text-center">
											<?php if ($row['status'] == 1) : ?>
												<span class="badge badge-primary">Verified</span>
											<?php else : ?>
												<span class="badge badge-secondary">Not Verified</span>
											<?php endif; ?>

										</td>
										<td class="text-center">
											<button class="btn btn-sm btn-outline-primary view_alumni" type="button" data-id="<?php echo $row['id'] ?>">View</button>
											<button class="btn btn-sm btn-outline-danger delete_alumni" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
										</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>

</div>
<style>
	td {
		vertical-align: middle !important;
	}

	td p {
		margin: unset
	}

	img {
		max-width: 100px;
		max-height: 150px;
	}

	.avatar {
		display: flex;
		border-radius: 100%;
		width: 100px;
		height: 100px;
		align-items: center;
		justify-content: center;
		border: 3px solid;
		padding: 5px;
	}

	.avatar img {
		max-width: calc(100%);
		max-height: calc(100%);
		border-radius: 100%;
	}
</style>
<script>
	$(document).ready(function() {
		$('table').dataTable()
	})

	$('.view_alumni').click(function() {
		uni_modal("Bio", "view_alumni.php?id=" + $(this).attr('data-id'), 'mid-large')

	})
	$('.delete_alumni').click(function() {
		_conf("Are you sure to delete this alumni?", "delete_alumni", [$(this).attr('data-id')])
	})

	function delete_alumni($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_alumni',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully deleted", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
</script>
<script>
	$(document).ready(function() {
		$("#batch_start").datepicker({
			format: " yyyy",
			viewMode: "years",
			minViewMode: "years"
		});
		$("#batch_start").change(function() {
			var date = new Date();
			var cy = date.getFullYear();
			var y = $(this).val();
			if (y > cy) {
				$(this).val(date.getFullYear())
				$(".error_batch_start").text("Batch must not exceed to current year.")
				$(".btnsave_").attr("disabled", true);

			} else {
				$(this).val(y)
				$(".error_batch_start").text("")
				$(".btnsave_").attr("disabled", false);
			}
		});

		$("#batch_end").datepicker({
			format: " yyyy",
			viewMode: "years",
			minViewMode: "years"
		});
		$("#batch_end").change(function() {
			var date = new Date();
			var cy = date.getFullYear();
			var y = $(this).val();
			if (y > cy) {
				$(this).val(date.getFullYear())
				$(".error_batch_end").text("Batch must not exceed to current year.")
				$(".btnsave_").attr("disabled", true);

			} else {
				$(this).val(y)
				$(".error_batch_end").text("")
				$(".btnsave_").attr("disabled", false);
			}
		});
	})
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
	$(document).ready(function() {
		$('#batch').daterangepicker({
			autoUpdateInput: false,
			minDate: 1990, // Set minimum date to the start of the current year
			maxDate: moment(), // Set maximum date to the current date
			showDropdowns: true,
			minYear: 1900, // Optional: Set the minimum selectable year
			maxYear: moment().year(), // Optional: Set the maximum selectable year as the current year
			opens: 'left', // Optional: Choose the side the calendar opens on
			ranges: {
				'All Years': [moment().startOf('year'), moment()],
			}
		});

		// Update the input field with the selected year range
		$('#batch').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('YYYY') + ' - ' + picker.endDate.format('YYYY'));
		});

		// Clear the input field when the user clears the date range
		$('#batch').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});
	});
</script>