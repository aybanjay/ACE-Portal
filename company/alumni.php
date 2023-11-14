<?php include('db_connect.php'); ?>
<style>
	.modal#interview_modal {
		position: fixed;
		top: 30%;
		left: 80%;
		z-index: 1050;
		display: none;
		width: 100%;
		height: 100%;
		overflow: hidden;
		outline: 0;
	}
</style>
<div class="container-fluid">

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
						<b>Alumni Applicants</b>
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
									<th class="">Job Applied for</th>
									<th class="">Application Status</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$alumni = $conn->query('SELECT users.id as user_id, alumnus_bio.*,alumnus_bio.id as alid, courses.course, CONCAT(alumnus_bio.lastname,", ",alumnus_bio.firstname," ",alumnus_bio.middlename) as `name`, applicants.date_interview as idate, applicants.status as application_status, applicants.date_updated, careers.job_title, careers.id as job_id FROM applicants JOIN careers ON careers.id = applicants.career_id JOIN users ON users.id = applicants.user_id JOIN alumnus_bio ON alumnus_bio.id = users.alumnus_id JOIN courses ON courses.id =  alumnus_bio.course_id WHERE careers.user_id = ' . $_SESSION['login_id'] . ' ORDER BY CONCAT(alumnus_bio.lastname,", ",alumnus_bio.firstname," ",alumnus_bio.middlename) ASC');
								if ($alumni->num_rows > 0) {
									$i = 1;

									while ($row = $alumni->fetch_assoc()) :

								?>
										<tr>
											<td class="text-center"><?php echo $i++ ?></td>
											<td class="text-center">
												<div class="avatar">
													<img src="../admin/assets/uploads/<?php echo trim($row['avatar'], "uploads/"); ?>" class="" alt="">
												</div>
											</td>
											<td class="">
												<p> <b><?php echo ucwords($row['name']) ?></b></p>
											</td>
											<td class="">
												<p> <b><?php echo $row['course'] ?></b></p>
											</td>
											<td class="text-center">
												<p> <b><?php echo $row['job_title'] ?></b></p>
											</td>
											<td class="text-center">
												<?php
												switch ($row['application_status']) {
													case 1:
														$application_class = 'text-info';
														$application_status = 'Shortlisted';
														$vrb = "as of";
														$date = date('M d, Y h:i A', strtotime($row['date_updated']));
														break;
													case 2:
														$application_class = 'text-warning';
														$application_status = 'Interview';
														$date = date('M d, Y h:i A', strtotime($row['idate']));
														$vrb = "is on";
														break;
													case 3:
														$application_class = 'text-success';
														$application_status = 'Hired';
														$vrb = "as of";
														$date = date('M d, Y h:i A', strtotime($row['date_updated']));
														break;
													default:
														$application_class = 'text-secondary';
														$application_status = 'Pending';
														$vrb = "";
														$date = "";
														break;
												}

												?>
												<p> <b><span class="<?php echo $application_class; ?>"><?php echo $application_status; ?> </span> <?= $vrb; ?> <?php echo $date;  ?></b></p>
											</td>
											<td class="text-center">
												<div class="btn-group">
													<button type="button" class="btn btn-secondary">Action</button>
													<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">

													</button>
													<div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
														<!-- <a class="dropdown-item" href="#">Action</a>
														<a class="dropdown-item" href="#">Another action</a>
														<a class="dropdown-item" href="#">Something else here</a> -->
														<?php if (!$row['application_status']) { ?>
															<button class=" dropdown-item btn btn_alumni_action btn-sm btn-outline-primary shortlist_alumni" type="button" data-id="<?php echo $row['user_id'] ?>" data-status="1" data-career_id="<?php echo $row['job_id']; ?>">Shortlist</button>
														<?php } else if ($row['application_status'] == 1) { ?>
															<button class=" dropdown-item btn  btn-sm btn-outline-primary interview_alumni" type="button" data-id="<?php echo $row['user_id'] ?>" data-status="2" data-career_id="<?php echo $row['job_id']; ?>">Interview</button>
														<?php } else if ($row['application_status'] == 2) { ?>
															<button class=" dropdown-item btn btn-sm btn-outline-primary hire_alumni" type="button" data-id="<?php echo $row['user_id'] ?>" data-status="3" data-career_id="<?php echo $row['job_id']; ?>">Hire</button>
														<?php }  ?>
														<button class="btn  dropdown-item btn-sm btn-outline-primary view_alumni" type="button" data-id="<?php echo $row['alid'] ?>">View</button>

														<button class="btn  dropdown-item btn-sm btn-outline-primary view_cv" type="button" data-id="<?php echo $row['alid'] ?>">Curriculum Vitae</button>

													</div>
												</div>

											</td>
											<td>

											</td>
										</tr>
								<?php endwhile;
								} ?>
							</tbody>
						</table>
						<?php include("modal/interview_date.php") ?>
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
	(function() {
		emailjs.init("wbHWxY4JCd8YgpQ82");
	})();
</script>
<script>
	$(document).ready(function() {
		$('table').dataTable()
	});

	$('.view_alumni').click(function() {
		uni_modal("Bio", "view_alumni.php?id=" + $(this).attr('data-id'), 'mid-large')

	});

	$(document).on("click", ".interview_alumni", function() {
		let uid = $(this).data("id");
		let status = $(this).data("status");
		let cid = $(this).data("career_id");

		$("#interview_modal").modal("show")
		$("#btnset").click(function() {
			let idate = $("#idate").val()

			if (idate == "") {
				$("._emsg").text("Set a valid date.")
			} else {

				$.ajax({
					url: "action/interview_action.php",
					method: "POST",
					data: {
						uid: uid,
						cid: cid,
						idate: idate
					},
					dataType: "JSON",
					success: function(data) {
						if (data.status == 200) {
							console.log(true)
							$.ajax({
								url: "action/fetch_email.php",
								method: "POST",
								data: {
									uid: uid,
									cid: cid,
									idate: idate
								},
								dataType: "JSON",
								success: function(data) {
									var company = data.company
									var email = data.umail
									var iname = data.iname

									var templateParams = {
										idate: idate,
										company: company,
										iname: iname,
										email: email,

									};

									emailjs.send('service_hld33hj', 'template_2qmc856', templateParams)
										.then(function(response) {
											console.log('SUCCESS!', response.status, response.text);
											toastr["success"]("The applicant has been notified", "Email sent")
											setTimeout(function() {
												location.reload()
											}, 2000)
										}, function(error) {
											console.log('FAILED...', error);
											alert_toast("Error occured in this action! Please4 refresh the page.", "error")
										});
								}
							})
						} else {
							console.log(false)
						}
					}
				})
			}
		})


	});
	$('.btn_alumni_action').click(function(e) {

		e.preventDefault();
		start_load();
		$.ajax({
			url: 'ajax.php?action=alumni-action',
			method: 'POST',
			data: {
				id: $(e.currentTarget).data('id'),
				status: $(e.currentTarget).data('status'),
				career_id: $(e.currentTarget).data('career_id'),
			},
			success: function(resp) {
				if (resp == 1) {

					location.reload();
				} else {
					alert_toast("Oops! Something went wrong!", 'danger');
				}
			},

			error: function(err) {
				alert_toast("Oops! Something went wrong!", 'danger');
			},
			complete: function() {
				end_load();
			}
		});
	});

	//View CV

	$(document).on("click", ".view_cv", function() {
		//alert($(this).data("id"));
		window.open('view_cv.php?id=' + $(this).data("id"), '_blank')
		//window.location.href = 'view_cv.php?id='+$(this).data("id")
	})

	$(document).on("click", ".hire_alumni", function() {
		let career_id = $(this).data("career_id")
		let user_id = $(this).data("id")
		$.ajax({
			url: "action/hire_action.php",
			method: "POST",
			data: {
				career_id: career_id,
				user_id: user_id
			},
			dataType: "JSON",
			success: function(data) {
				if (data.status == 200) {
					alert_toast('Applicant hired!', 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)
				} else {
					alert_toast('Something wrong. Please refresh the page.', 'danger')
				}
			}
		})
	})
</script>