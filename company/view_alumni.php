<?php include 'db_connect.php' ?>

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
	<?php
	if (isset($_GET['id'])) {
		$qry = $conn->query("SELECT a.*,c.course,Concat(a.lastname,', ',a.firstname,' ',a.middlename) as name from alumnus_bio a inner join courses c on c.id = a.course_id where a.id= " . $_GET['id']);
		$row = $qry->fetch_assoc();

		//	echo json_encode($row);
		// 	foreach ($qry->fetch_array() as $k => $val) {
		// 		$k = $val;
		// 	}
		// }
	?>
		<div class="col-lg-12">
			<div>
				<center>
					<div class="avatar">
						<img src="../admin/assets/uploads/<?php echo trim($row['avatar'], "uploads/"); ?>" class="" alt="">
					</div>
				</center>
			</div>
			<hr>


			<div class="row">
				<div class="col-md-6">
					<p>Name: <b><?php echo $row['name']; ?></b></p>
					<p>Email: <b><?php echo $row['email']; ?></b></p>
					<p>Batch: <b><?php echo $row['batch']; ?></b></p>
					<p>Course: <b><?php echo $row['course']; ?></b></p>
				</div>
				<div class="col-md-6">
					<p>Gender: <b><?php echo $row['gender']; ?></b></p>

				</div>
			</div>
		</div>
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-lg-12">
			<button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
<script>
	$('.update').click(function() {
		start_load()
		$.ajax({
			url: 'ajax.php?action=update_alumni_acc',
			method: "POST",
			data: {
				id: <?php echo $id ?>,
				status: $(this).attr('data-status')
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Alumnus/Alumna account status successfully updated.")
					setTimeout(function() {
						location.reload()
					}, 1000)
				}
			}
		})
	})
</script>
<?php
	}
?>