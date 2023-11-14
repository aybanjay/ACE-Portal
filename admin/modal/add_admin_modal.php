<div class="modal fade" id="new_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="frm_add_admin">
            <div class="modal-body">
                    <div class="text-danger error_uname"></div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name_admin" id="name_admin" class="form-control"required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username_admin" id="username_admin" class="form-control"required autocomplete="off" style="text-transform: lowercase;">
                    </div>
                    <div class="form-group">
					<label for="type">User Type</label>
					<select name="type_admin" id="type_admin" class="custom-select">
						<option value="2">Co-admin</option>
						<option value="1">Admin</option>
					</select>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>