<?php
session_start();




?>

<?php include('layout/header.php'); ?>
<?php include_once('../admin/db_connect.php'); ?>
<style>
    .cap{
        text-transform: capitalize;
    }
</style>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-center p-5">
                            <div class="brand-logo">
                                <img src="assets/images/hr.png">
                            </div>
                            <h4>New Here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps.</h6>
                            <form class="pt-3" id="frmregister">
                                <div class="form-group">
                                    <input type="text" required  class="form-control form-control-lg cap" id="fname" name="fname" placeholder="Full Name">
                                </div>

                                <div class="form-group">
                                    <input type="email" required   class="form-control form-control-lg" id="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" required   class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" required   class="form-control form-control-lg" id="cpass" placeholder="Confirm Password">
                                </div>
                                <div class="text-center mt-0 text-danger pass_error font-weight-light"> 
                                </div>
                                <div class="mt-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>

                                </div>

                                <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="index.php" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>

    </div>
</body>
<?php include('layout/script.php') ?>
<script>
    	$(function() {
		$('.cap').bind('keyup input', function() {
			if (this.value.match(/[^a-zA-Z áéíóúÁÉÍÓÚüÜ]/g)) {
				this.value = this.value.replace(/[^a-zA-Z áéíóúÁÉÍÓÚüÜ]/g, '');
			}
		});
	});
</script>
<script>
    $(document).ready(function() {
        $("#frmregister").on("submit", function(e) {
            e.preventDefault();
            var pass = $("#password").val();
            var cpass = $("#cpass").val();
            if (pass === cpass) {
                $.ajax({
                    url: "action/register_action.php",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(data) {
                        if (data.statusCode == 202) {
                            toastr["error"]('Email is already used!', 'Error');
                        } else if (data.statusCode == 200) {
                            toastr["success"]('Your account has been created. You will be redirected to login.', 'Congratulations');
                            setTimeout(function() {
                                window.location.href = "index.php";
                            }, 2000)
                        } else {
                            toastr["error"]('Error creating your account.', 'Error');
                        }
                    }
                })
            } else {    
                $(".pass_error").text('Password do not match.');
            }

        })
    })
</script>

</html>

