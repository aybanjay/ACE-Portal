<?php session_start();   ?>

<?php include('layout/header.php'); ?>
<?php include_once('../admin/db_connect.php'); ?>

<style type="text/css">
    
    .auth-form-btn{
        height: 80px;
        width: 150px;
        padding: 0;
       text-align: center;

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

                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <?php if (isset($_SESSION['msg'])) {

                            ?>
                                <h5 class="font-weight-light text-danger"><?php echo $_SESSION['msg']; ?></h5>
                            <?php
                                unset($_SESSION['msg']);
                            } ?>

                            <form class="pt-3" method="post" action="action/login_action.php" id="frmlogin">
                                <div class="form-group">
                                    <input type="email" required class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" required class="form-control form-control-lg" name="pass" id="pass" placeholder="Password">
                                </div>
                                <div class="text-start formCheck">

                                    <input class="form-check-input" type="checkbox" value="" id="password_show_hr">
                                    <label class="form-check-label" for="password_show_hr">
                                        Show password
                                    </label>
                                </div>
                                <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                                   
                                   <a href="#" class="auth-link text-black">Forgot password?</a>
                               </div> -->
                                <div class="mt-5 d-flex justify-content-center">
                                    <button type="submit" name="btnlogin" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>

                                </div>


                                <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.php" class="text-primary">Create</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
</body>
<?php include('layout/script.php') ?>
<script>
    $(document).ready(function() {
        $(".formCheck").click(function() {

            if ($("#password_show_hr").prop("checked") == true) {
                $("input[type=password]").attr("type", "text")
            } else {
                $("#pass").attr("type", "password")
            }

        });
    });
</script>

</html>