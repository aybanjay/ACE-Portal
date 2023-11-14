<?php session_start();
include 'admin/db_connect.php' ?>
<?php

if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM careers where id=" . $_GET['id'])->fetch_array();
	foreach ($qry as $k => $v) {
		$$k = $v;
	}
}

?>
<div class="container-fluid">
	<p>Job Title: <b>
			<large><?php echo ucwords($job_title) ?></large>
		</b></p>
	<p>Company: <b>
			<large><?php echo ucwords($company) ?></large>
		</b></p>
	<p>Location: <b>
			<large><?php echo $location ?></large>
		</b></p>
	<hr class="divider-light">
	<?php echo html_entity_decode($description) ?>


</div>

<?php

$sql = $conn->query("SELECT * FROM users WHERE id = '$user_id'");
$row = $sql->fetch_assoc();

?>

<div class="modal-footer display">
	<div class="row">
		<div class="col-md-6">
			<button class="btn float-right btn-danger" type="button" data-dismiss="modal">Close</button>
		</div>

		<div class="col-md-6">
			<?php if (isset($_SESSION['login_alumnus_id']) && $_SESSION['login_alumnus_id'] > 0) { ?>

				<button class="btn float-left btn-success btn-apply" data-dismiss="modal" data-id="<?php echo $id; ?>" type="button">Apply</button>

			<?php } else { ?>
				<span class="btn btn-outline">Login as Alumni to apply</span>
			<?php } ?>
		</div>
	</div>
</div>
<style>
	p {
		margin: 0 auto;
	}

	#uni_modal .modal-footer {
		display: none;
	}

	#uni_modal .modal-footer.display {
		display: block;
	}
</style>
<script>
	$('.text-jqte').jqte();
	<?php if (isset($_SESSION['login_alumnus_id']) && $_SESSION['login_alumnus_id'] > 0) { ?>
		$('body').on('click', '.btn-apply', function(e) {
			start_load()
			$.ajax({
				url: 'admin/ajax.php?action=apply_career',
				method: 'POST',
				data: {
					id: $(e.currentTarget).data('id')
				},
				success: function(resp) {
					if (resp == 1) {		
						setTimeout(function(){
							location.reload();
						},1500)			
						alert_toast("Successfully applied!.", 'success')
					
					} else if (resp == 2) {
						alert_toast("Missing id!", 'danger');
					} else if (resp == 3) {
						alert_toast("You already applied to this job post!", 'warning');
						setTimeout(function(){
							location.reload();
						},1500)
						
						
					} else {
						alert_toast("Oops! Something went wrong!", 'danger');
					}
				},
				complete: function() {
					end_load();
				}
			})
		});
	<?php } ?>
	$('#manage-career').submit(function(e) {
		e.preventDefault()
		start_load()
		$.ajax({
			url: 'admin/ajax.php?action=save_career',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully saved.", 'success')
					setTimeout(function() {
						location.reload()
					}, 1000)
				}
			}
		})
	})
</script>