<?php include 'db_connect.php' ?>
<?php

$qry = $conn->query("SELECT a.*,c.course,Concat(a.lastname,', ',a.firstname,' ',a.middlename) as name from alumnus_bio a inner join courses c on c.id = a.course_id where a.id= " . $_GET['id']);
// foreach ($qry->fetch_array() as $k => $val) {
// 	$$k = $val;
// }
$row = $qry->fetch_assoc();

?>
<style type="text/css">
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

	p {
		margin: unset;
	}

	#uni_modal .modal-footer {
		display: none
	}

	#uni_modal .modal-footer.display {
		display: block
	}
</style>

<div class="container-field">

	<div class="col-lg-12">
		<div>
			<center>
				<div class="avatar">
					<img src="assets/uploads/<?php echo trim($row['avatar'],"uploads/"); ?>" class="" alt="">

				</div>
				
		
			</center>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<p>Name: <b><?php echo $row['name'] ?></b></p>
				<p>Email: <b><?php echo $row['email'] ?></b></p>
				<input type="hidden" id="_email" value="<?php echo $row['email'] ?>">
				<p>Batch: <b><?php echo $row['batch'] ?></b></p>
				<p>Course: <b><?php echo $row['course'] ?></b></p>
			</div>
			<div class="col-md-6">
				<p>Address: <b><?php echo $row['address'] ?></b></p>
				</p>
				<p>Gender: <b><?php echo $row['gender'] ?></b></p>
				<p>Account Status: <b><?php echo $row['status'] == 1 ? '<span class="badge badge-primary">Verified</span>' : '<span class="badge badge-secondary">Unverified</span>' ?></b></p>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-lg-12">
			<button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
			 <?php if ($row['status'] == 1) : ?>
				<!-- <button class="btn float-right btn-primary update mr-2" data-status='0' type="button" data-dismiss="modal">Unverify Account</button> -->
			<?php else : ?>
				<button class="btn float-right btn-primary update mr-2" data-id="<?php echo $row['id']; ?>" data-status='1' type="button" >Verify Account</button>
			<?php endif; ?> 
		</div>
	</div>
</div>
<script>
	(function() {
		emailjs.init("user_NTdHCA9zp9sC7gmz1ncCT");
	})();
</script>
<script>
	$('.update').click(function() {
		var id = $(this).data("id");
		start_load()
		$.ajax({
			url: 'ajax.php?action=update_alumni_acc',
			method: "POST",
			data: {
				id: id,
				status: $(this).attr('data-status')
			},
			success: function(resp) {
				if (resp == 1) {


					let email = $("#_email").val();
					var templateParams = {
					
						notes: 'Check this out!',
						email: email,
					};
					emailjs.send('service_1xn6ru3', 'template_ruzizkq', templateParams)
						.then(function(response) {
							console.log('SUCCESS! Email sent!', response.status, response.text);
							alert_toast("Alumnus/Alumna account status successfully updated.")
							setTimeout(function() {
								location.reload()
							}, 1500)
							//window.location.href = 'index.php';
							//  $('#form-forgot-password').prepend('<div class="alert alert-success">Password reset link has been sent to ' + email + '.</div>');
						}, function(error) {
							alert('FAILED... Please try again', error);
							//  $('#form-forgot-password').prepend('<div class="alert alert-danger">There is an error sending password link to ' + email + '.</div>');
							//alert_toast("")
						});

				}
			}
		})
	})
</script>