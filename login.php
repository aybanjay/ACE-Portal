<?php session_start() ?>

<div class="container-fluid">
	<form action="" id="login-frm">

		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="email" name="email" required="" class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" name="password" required="" class="form-control">
			<div class="form-check">

				<input class="form-check-input" type="checkbox" value="" id="password_show_">
				<label class="form-check-label" for="password_show_">
					Show password
				</label>
			</div>
			<small><a href="index.php?page=signup" id="new_account">Create New Account</a></small> | <small><a href="index.php?page=forgot_password" id="new_account">Forgot Password?</a></small>
		</div>

		<div class="row">
			<div class="col-sm-5">
				<button class="cssbuttons-io-button">Login
					<div class="icon">
						<svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 0h24v24H0z" fill="none"></path>
							<path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
						</svg>
					</div>
				</button>
			</div>

			<div class="col-sm-5">
				<button type="button" class="cancel-btn" data-dismiss="modal">Cancel</button>
			</div>
		</div>

	</form>
</div>

<style>
	#uni_modal .modal-footer {
		display: none;
	}

	/* css for login button */

	.cssbuttons-io-button {
		background: #a3810f;
		color: white;
		font-family: inherit;
		padding: 0.35em;
		padding-left: 1.2em;
		font-size: 17px;
		font-weight: 500;
		border-radius: 0.9em;
		border: none;
		letter-spacing: 0.05em;
		display: flex;
		align-items: center;
		box-shadow: inset 0 0 1.6em -0.6em #a3810f;
		overflow: hidden;
		position: relative;
		height: 2.8em;
		padding-right: 3.3em;
	}

	.cssbuttons-io-button .icon {
		background: white;
		margin-left: 1em;
		position: absolute;
		display: flex;
		align-items: center;
		justify-content: center;
		height: 2.2em;
		width: 2.2em;
		border-radius: 0.7em;
		box-shadow: 0.1em 0.1em 0.6em 0.2em #a3810f;
		right: 0.3em;
		transition: all 0.3s;
	}

	.cssbuttons-io-button:hover .icon {
		width: calc(100% - 0.6em);
	}

	.cssbuttons-io-button .icon svg {
		width: 1.1em;
		transition: transform 0.3s;
		color: #a3810f;
	}

	.cssbuttons-io-button:hover .icon svg {
		transform: translateX(0.1em);
	}

	.cssbuttons-io-button:active .icon {
		transform: scale(0.95);
	}

	.cancel-btn {
		padding: 0.35em;
		padding-left: 1.2em;
		border: unset;
		border-radius: 0.9em;
		height: 2.8em;
		padding-right: 1.5em;
		color: #030000;
		letter-spacing: 0.05em;
		z-index: 1;
		background: #858181;
		position: relative;
		font-weight: 500;
		font-size: 17px;
		-webkit-box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
		box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
		transition: all 250ms;
		overflow: hidden;
	}

	.cancel-btn::before {
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		width: 0;
		border-radius: 15px;
		background-color: #d61821;
		z-index: -1;
		-webkit-box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
		box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
		transition: all 250ms
	}

	.cancel-btn:hover {
		color: #e8e8e8;
	}

	.cancel-btn:hover::before {
		width: 100%;
	}
</style>
<script>
	   $(document).ready(function() {
        $(".form-check").click(function() {

            if ($("#password_show_").prop("checked") == true) {
                $("input[type=password]").attr("type", "text")
            } else {
                $("input[type=text]").attr("type", "password")
            }

        });
	});
</script>
<script>
	$('#login-frm').submit(function(e) {
		e.preventDefault()
		$('#login-frm button[type="submit"]').attr('disabled', true).html('Logging in...');
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'admin/ajax.php?action=login2',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');

			},
			success: function(resp) {
				if (resp == 1) {
					location.href = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home' ?>';
				} else if (resp == 2) {
					$('#login-frm').prepend('<div class="alert alert-danger">Your account is not yet verified.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				} else {
					$('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>