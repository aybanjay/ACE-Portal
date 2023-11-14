<?php

?>

<div class="container-fluid">

	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-primary float-right btn-sm mt-3"  data-toggle="modal" data-target="#new_user_modal"><i class="fa fa-plus"></i> New user</button>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Name</th>
							<th class="text-center">Username</th>
							<th class="text-center">Type</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include 'db_connect.php';
						$type = array("", "Admin", "Co-admin", "Alumnus/Alumna", "Company", "Human Resource");
						$users = $conn->query("SELECT * FROM users order by name asc");
						$i = 1;
						while ($row = $users->fetch_assoc()) :
						?>
							<tr>
								<td class="text-center">
									<?php echo $i++ ?>
								</td>
								<td>
									<?php echo ucwords($row['name']) ?>
								</td>

								<td>
									<?php echo $row['username'] ?>
								</td>
								<td>
									<?php echo $type[$row['type']] ?>
								</td>
								<td>
									<center>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Action</button>
											<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="sr-only">Toggle Dropdown</span>
											</button>
											<div class="dropdown-menu">
												<a class="dropdown-item edit_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Edit</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item delete_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Delete</a>
											</div>
										</div>
									</center>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php include("modal/add_admin_modal.php");  ?>
</div>
<script>
	$('table').dataTable();
	$('#new_user').click(function() {
		uni_modal('New User', 'manage_user.php')
	})
	$('.edit_user').click(function() {
		uni_modal('Edit User', 'manage_user.php?id=' + $(this).attr('data-id'))
	})
	$('.delete_user').click(function() {
		_conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')])
	})

	function delete_user($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_user',
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
	$(function() {
		$('#name_admin').bind('keyup input', function() {
			if (this.value.match(/[^a-zA-Z áéíóúÁÉÍÓÚüÜ]/g)) {
				this.value = this.value.replace(/[^a-zA-Z áéíóúÁÉÍÓÚüÜ]/g, '');
			}
		});
	});
	$('#frm_add_admin').submit(function(e) {
		e.preventDefault();
		//start_load()
		$.ajax({
			url: 'action/add_admin.php',
			method: 'POST',
			data: $(this).serialize(),
			dataType: "JSON",
			success: function(resp) {
				//alert(resp.status)
				if (resp.status == 1) {
					$(".error_uname").text("Username already exist. Please create a unique username.");
				} else if(resp.status == 0){
					$("#new_user_modal").modal("hide");
					setTimeout(function(){
						alert_toast("New user successfully added. The page will refresh for a moment.",'success');
					},500)
					setTimeout(function(){
						location.reload();
					},1500)
					
				}
				 else {
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					
				}
			}
		})
	})
</script>
