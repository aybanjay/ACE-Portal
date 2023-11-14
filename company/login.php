<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<?php
include('./db_connect.php');
ob_start();
if (!isset($_SESSION['system'])) {
	$system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach ($system as $k => $v) {
		$_SESSION['system'][$k] = $v;
	}
}
ob_end_flush();
?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link rel="icon" href="assets/img/websitelogo.jpg">
	<title>Company Login</title>


	<?php include('./header.php'); ?>
	<?php
	if (isset($_SESSION['login_id']))
		header("location:index.php?page=home");

	?>

</head>
<style>
	body {
		width: 100%;
		height: calc(100%);

	}

	main#main {
		width: 100%;
		height: calc(100%);
		background: white;
	}

	#login-right {
		position: absolute;
		right: 0;
		width: 40%;
		height: calc(100%);
		background: white;
		display: flex;
		align-items: center;
	}

	#login-left {
		position: absolute;
		left: 0;
		width: 60%;
		height: calc(100%);
		background: #59b6ec61;
		display: flex;
		align-items: center;
		background: white;
		background-repeat: no-repeat;
		background-size: cover;
	}

	#login-right .card {
		margin: auto;
		z-index: 1
	}

	.logo {
		margin: auto;
		font-size: 8rem;
		background: white;
		padding: .5em 0.7em;
		border-radius: 50% 50%;
		color: #000000b3;
		z-index: 10;
	}

	div#login-right::before {
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		width: calc(100%);
		height: calc(100%);
		background: #000000e0;
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
</style>

<body>


	<main id="main" class="bg-light">
		<div id="login-left">
			<img class="bg-image" src="assets/img/upang.jpg">
		</div>

		<div id="login-right">
			<div class="card col-md-8">
				<div class="card-body">
					<h3>Company Login</h3>
					<form id="login-form">
						<div class="form-group">
							<label for="username" class="control-label">Username</label>
							<input type="text" id="username" name="username" class="form-control">
						</div>
						<div class="form-group">
							<label for="password" class="control-label">Password</label>
							<input type="password" id="password" name="password" class="form-control">
						</div>

						<div class="form-check my-3">

							<input class="form-check-input" type="checkbox" value="" id="password_show_com">
							<label class="form-check-label" for="password_show_com">
								Show password
							</label>
						</div>
						<button class="cssbuttons-io-button">Login
							<div class="icon">
								<svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
								</svg>
							</div>
						</button>
						<small><a href="signup.php" id="new_account">Don't have an account yet? Sign up now!</a></small>

					</form>
				</div>
			</div>
		</div>


	</main>



	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$(document).ready(function() {
		$(".form-check").click(function() {

			if ($("#password_show_com").prop("checked") == true) {
				$("input[type=password]").attr("type", "text")
			} else {
				$("#password").attr("type", "password")
			}

		});
	});
</script>
<script>
	$('#login-form').submit(function(e) {
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'ajax.php?action=login',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success: function(resp) {
				if (resp == 1) {
					location.href = 'index.php?page=home';
				} else {
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>

</html>