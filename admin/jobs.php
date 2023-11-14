<?php include('db_connect.php'); ?>

<div class="container-fluid">
	<style>
		input[type=checkbox] {
			/* Double-sized Checkboxes */
			-ms-transform: scale(1.5);
			/* IE */
			-moz-transform: scale(1.5);
			/* FF */
			-webkit-transform: scale(1.5);
			/* Safari and Chrome */
			-o-transform: scale(1.5);
			/* Opera */
			transform: scale(1.5);
			padding: 10px;
		}
	</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">

			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Jobs List</b>
						<span class="">


						</span>
					</div>
					<div class="card-body">

						<table class="table table-bordered table-condensed table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Company</th>
									<th class="">Job Title</th>
									<th class="">Posted By</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$jobs =  $conn->query("SELECT c.*,u.name from careers c inner join users u on u.id = c.user_id order by id desc");
								while ($row = $jobs->fetch_assoc()) :

								?>
									<tr>

										<td class="text-center"><?php echo $i++ ?></td>
										<td class="">
											<p><b><?php echo ucwords($row['company']) ?></b></p>

										</td>
										<td class="">
											<p><b><?php echo ucwords($row['job_title']) ?></b></p>

										</td>
										<td class="">
											<p><b><?php echo ucwords($row['name']) ?></b></p>

										</td>
										<td>
											<div class="dropdown">
												<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Action
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<?php if (!$row['confirmed_at']) { ?>
														<a class="dropdown-item confirm_career" href="#"  data-id="<?php echo $row['id'] ?>">Confirm</a>
													<?php } ?>
													<a class="dropdown-item view_career" href="#"  data-id="<?php echo $row['id'] ?>">View</a>
													<a class="dropdown-item edit_career" href="#" data-id="<?php echo $row['id'] ?>">Edit</a>
													<a class="dropdown-item delete_career" href="#" data-id="<?php echo $row['id'] ?>">Delete</a>
												</div>
											</div>
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
</style>
<script>
	(function() {
		emailjs.init("wbHWxY4JCd8YgpQ82");
	})();
</script>
<script>
	$(document).ready(function() {
		$('table').dataTable()
	})
	$('#new_career').click(function() {
		uni_modal("New Entry", "manage_career.php", 'mid-large')
	})

	$('.edit_career').click(function() {
		uni_modal("Manage Job Post", "manage_career.php?id=" + $(this).attr('data-id'), 'mid-large')

	})
	$('.view_career').click(function() {
		uni_modal("Job Opportunity", "view_jobs.php?id=" + $(this).attr('data-id'), 'mid-large')

	})
	$('.delete_career').click(function() {
		_conf("Are you sure to delete this post?", "delete_career", [$(this).attr('data-id')], 'mid-large')
	})

	$('.confirm_career').click(function() {
		_conf("Are you sure you'd like to confirm and approve this job?", "confirm_career", [$(this).attr('data-id')], 'mid-large')
	});


	function confirm_career($id) {


		$.ajax({
			url: 'ajax.php?action=confirm_career',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {

				if (resp == 1) {

					$.ajax({
						url: "action/fetch_email.php",
						method: "POST",
						data: {
							type: 1,
							id: $id
						},
						dataType: "JSON",
						success: function(data) {
							var myId = data.user_id;
							$.ajax({
								url: "action/fetch_email.php",
								method: "POST",
								data: {
									type: 2,
									id: myId
								},
								dataType: "JSON",
								success: function(data) {
									alert(data.username)
									var email = data.username;
									var templateParams = {

										email: email,

									};

									emailjs.send('service_hld33hj', 'template_njgbp0x', templateParams)
										.then(function(response) {
											console.log('SUCCESS!', response.status, response.text);
											alert_toast("Job successfully posted", 'success')
											setTimeout(function() {
												location.reload()
											}, 1500)
											//	$('#form-forgot-password').prepend('<div class="alert alert-success">Password reset link has been sent to ' + email + '.</div>');
										}, function(error) {
											alert('FAILED...', error);
											//	$('#form-forgot-password').prepend('<div class="alert alert-danger">There is an error sending password link to ' + email + '.</div>');
										});


								}
							})


						}
					})

				} else if (resp == 2) {
					alert_toast("Missing id!", 'danger');
				} else {
					alert_toast("Oops! Something went wrong!", 'danger');
				}
			},
			complete: function() {
				end_load()
			}
		})
	}

	function delete_career($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_career',
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
			},
			complete: function() {
				end_load()
			}
		})
	}
</script>