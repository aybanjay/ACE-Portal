<?php session_start();
include 'db_connect.php' ?>
<?php
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM careers where user_id = " . $_SESSION['login_id'] . " AND id=" . $_GET['id'])->fetch_array();
	foreach ($qry as $k => $v) {
		$$k = $v;
	}
}

?>
<div class="container-fluid">
	<form action="" id="manage-career">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>" class="form-control">
		<div class="row form-group">
			<div class="col-md-8">
				<label class="control-label">Company</label>
				<input type="text" name="company" class="form-control" readonly value="<?php echo $_SESSION['login_company'] ?>">
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-8">
				<label class="control-label">Job Title</label>
				<input type="text" name="title" required class="form-control tit" value="<?php echo isset($job_title) ? $job_title : '' ?>">
				<div class="text-danger err_t"></div>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-8">
				<label class="control-label">Location</label>
				<input type="text" name="location" required class="form-control loc" value="<?php echo isset($location) ? $location : '' ?>">
				<div class="text-danger err_l"></div>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Description</label>
				<textarea name="description" required class="text-jqte desc_req"><?php echo isset($description) ? $description : '' ?></textarea>
				<div class="text-danger err_desc"></div>
			</div>
		</div>
	</form>
</div>

<script>
	$('.text-jqte').jqte();
	$('#manage-career').submit(function(e) {
		e.preventDefault()
		var d = 0;
		var t = 0;
		var l = 0;
		if ($(".desc_req").val() == "") {
			$(".err_desc").text("This field is required!");
			d = 1;
		}else{
			d = 0;
		}
		if($(".loc").val() == "") {
			$(".err_l").text("This field is required!");
			l = 1;
		}else{
			l = 0;
		}
		if($(".tit").val() == "") {
			$(".err_t").text("This field is required!");
			t = 1;
		}else{
			t = 0;
		}
		if(d==1 || t==1 || l==1){
			toastr['error']("You cannot submit an empty field!")
		}
		else{
			$(".err_desc").text("");
			$(".err_l").text("");
			$(".err_t").text("");
			$.ajax({
				url: 'ajax.php?action=save_career',
				method: 'POST',
				data: $(this).serialize(),
				success: function(resp) {
					if (resp == 1) {
						$("#uni_modal").modal("hide");
						alert_toast("Data successfully saved.", 'success')
						setTimeout(function() {
							location.reload()
						}, 1000)
					}
				}
			})
		}

	})
</script>