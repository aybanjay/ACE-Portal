<?php

if (!isset($_GET['token'])) {
    header('location: /index.php?page=forgot_password');
    exit;
} else {
    $result = $conn->query('SELECT id FROM users WHERE password_token = "' . $conn->real_escape_string(urldecode($_GET['token'])) . '"');



?>

    <div class="container" style="margin-top: 120px">
        <div class="card w-50 mx-auto">
            <div class="card-body">
                <h4>Reset Password</h4>
                <?php if ($result->num_rows) {
                    $user = $result->fetch_assoc(); ?>
                    <div class="text-left ihide">
                        <div class="text-danger" id="length"><small class="length"></small></div>
                        <div class="text-danger" id="upper"><small class="upper"></small></div>
                        <div class="text-danger" id="lower"><small class="lower"></small></div>
                        <div class="text-danger" id="num"><small class="num"></small></div>
                        <div class="text-danger" id="sp"><small class="sp"></small></div>
                    </div>
                    <form id="form-reset-password">
                        <div class="form-group my-3">
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter your new password">

                        </div>
                        <div class="text-danger ihide" id="error_match"></div>
                        <div class="form-group">
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Retype and confirm your new password">
                        </div>
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>" />
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="password_show">
                            <label class="form-check-label ihide" for="password_show">
                                Show password
                            </label>
                        </div>
                        <div class="text-danger empty_input my-3 ihide"></div>
                        <button type="submit" class="btn btn-primary btn-block ">Submit</button>
                    </form>
                <?php } else { ?>
                    <div class="alert alert-danger">
                        Invalid token and email combination or token has been expired.
                    </div>
                <?php } ?>
            </div>
        </div>
        <h1><?php //echo $_GET['token']; 
            ?></h1>
    </div>

    <script>
        //password validation
        $(document).ready(function() {
            $(".form-check").click(function() {

                if ($("#password_show").prop("checked") == true) {
                    $("input[type=password]").attr("type", "text")
                } else {
                    $("input[type=text]").attr("type", "password")
                }

            });

            $("#new_password").on("keyup", function() {
                let l = 1;
                let u = 1;
                let lo = 1;
                let n = 1;
                let s = 1;
                let np = $("#new_password").val();
                var pwdLength = /^.{8,16}$/;
                var pwdUpper = /[A-Z]+/;
                var pwdLower = /[a-z]+/;
                var pwdNumber = /[0-9]+/;
                var pwdSpecial = /[!@#$%^&()'[\]"?+-/*={}.,;:_]+/;

                if (pwdLength.test(np) == false) {
                    $("#length").attr("class", "text-danger")
                    $(".length").text("Password must contain at least 8 characters and not over 16 characters!");
                    l = 1;

                } else {
                    $("#length").attr("class", "text-success")
                    $(".length").text("Password length satisfied.");
                    l = 0;

                }
                if (pwdUpper.test(np) == false) {
                    $("#upper").attr("class", "text-danger")
                    $(".upper").text("Password must contain uppercase!");
                    u = 1;

                } else {
                    $("#upper").attr("class", "text-success")
                    $(".upper").text("Password uppercase satisfied.");
                    u = 0;

                }
                if (pwdLower.test(np) == false) {
                    $("#lower").attr("class", "text-danger")
                    $(".lower").text("Password must contain lowercase!");
                    lo = 1;

                } else {
                    $("#lower").attr("class", "text-success")
                    $(".lower").text("Password lowercase satisfied.");
                    lo = 0;

                }
                if (pwdNumber.test(np) == false) {
                    $("#num").attr("class", "text-danger")
                    $(".num").text("Password must contain number!");
                    n = 1;

                } else {
                    $("#num").attr("class", "text-success")
                    $(".num").text("Password number satisfied.");
                    n = 0;

                }
                if (pwdSpecial.test(np) == false) {
                    $("#sp").attr("class", "text-danger")
                    $(".sp").text("Password must contain special character!");
                    s = 1;

                } else {
                    $("#sp").attr("class", "text-success")
                    $(".sp").text("Password special character satisfied.");
                    s = 0;

                }
                if (l == 1 || u == 1 || lo == 1 || n == 1 || s == 1) {
                    $(".empty_input").text("Password requirements not satisfied!")
                    $("button").attr("disabled", true);
                } else {
                    $(".empty_input").text("");
                    $("button").attr("disabled", false);
                }

            });

            $("#confirm_password").on("keyup", function() {
                let err = 1;
                let np = $("#new_password").val();
                let cp = $("#confirm_password").val();
                if (np == cp) {
                    $("#error_match").attr("class", "text-success")
                    $("#error_match").text("Password match!");
                    $("button").attr("disabled", false);
                } else {
                    $("#error_match").attr("class", "text-danger")
                    $("#error_match").text("Password don't match!");
                    $("button").attr("disabled", true);
                }
            })



        });
        //password validation end

        $('#form-reset-password').submit(function(e) {
            e.preventDefault()

            let np = $("#new_password").val();
            let cp = $("#confirm_password").val();
            if (np == "" || cp == "") {

                $(".empty_input").text("Ensure password fields are not empty!")

            } else {
                $('#form-reset-password button[type="submit"]').attr('disabled', true).html('Resetting Password...');
                if ($(this).find('.alert-danger').length > 0)
                    $(this).find('.alert-danger').remove();
                $.ajax({
                    url: 'admin/ajax.php?action=reset-password',
                    method: 'POST',
                    data: $(this).serialize(),
                    error: err => {
                        console.log(err)
                        $('#form-reset-password button[type="submit"]').removeAttr('disabled').html('Submit');

                    },
                    success: function(resp) {
                        if (resp == 1) {
                            $('#form-reset-password').prepend('<div class="alert alert-success">Password has been reset.</div>')
                            $(".ihide").hide();
                            //  $('#form-reset-password button[type="submit"]').attr('disabled', true).html('Password has been reset.');
                            $("button").hide();
                            $("input").hide();
                            $('#form-reset-password').prepend('You may now sign in  <a href="index.php">Login</a>')
                        } else if (resp == 2) {
                            $('#form-reset-password').prepend('<div class="alert alert-danger">Passwords should not be empty.</div>')
                            $('#form-reset-password button[type="submit"]').removeAttr('disabled').html('Submit');
                        } else if (resp == 3) {
                            $('#form-reset-password').prepend('<div class="alert alert-danger">Please confirm your new password.</div>')
                            $('#form-reset-password button[type="submit"]').removeAttr('disabled').html('Submit');
                        } else {
                            $('#form-reset-password').prepend('<div class="alert alert-danger">Oops! Something went wrong!</div>')
                            $('#form-reset-password button[type="submit"]').removeAttr('disabled').html('Submit');
                        }
                    }
                })
            }
        })
    </script>

<?php

}
?>