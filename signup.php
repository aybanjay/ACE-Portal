<?php
include 'admin/db_connect.php';
?>
<style>
    header.masthead,
    header.masthead:before {
        min-height: 40vh !important;
        height: 40vh !important
    }

    .masthead {
        min-height: 23vh !important;
        height: 23vh !important;
    }

    .masthead:before {
        min-height: 23vh !important;
        height: 23vh !important;
    }

    img#cimg {
        max-height: 10vh;
        max-width: 6vw;
    }

    .cap {
        text-transform: capitalize;
    }
</style>
<header class="masthead">
    <div class=" p-5 text-center bg-image h-100" style="background-image: linear-gradient(341deg, rgb(0 0 0 / 13%),rgb(0, 0, 0)),url('assets/img/upang.jpg'); background-size: cover;
 background-repeat: no-repeat; height: auto;">

        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="text-uppercase text-white font-weight-bold mt-5">
                <div class="col-lg-12 align-self-end mb-4">
                    <h3>Create Account</h3>
                </div>
            </div>

        </div>

    </div>
</header>
<div class="container mt-3 pt-2">
    <div class="col-lg-12">
        <div class="card mb-4 shadow-lg">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <form action="" id="create_account">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="" class="control-label">Last Name</label>
                                    <input type="text" class="form-control cap" name="lastname" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">First Name</label>
                                    <input type="text" class="form-control cap" name="firstname" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">Middle Name</label>
                                    <input type="text" class="form-control cap" name="middlename">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="" class="control-label">Gender</label>
                                    <select class="custom-select" name="gender" required>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">Batch</label>
                                    <input type="input" class="form-control datepickerY" id="batch" name="batch" required>
                                    <div class="text-danger error_batch"></div>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">Course Graduated</label>
                                    <select class="custom-select select2" name="course_id" required>
                                        <option></option>
                                        <?php
                                        $course = $conn->query("SELECT * FROM courses order by course asc");
                                        while ($row = $course->fetch_assoc()) :
                                        ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['course'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="" class="control-label">Address <small> <em> e.g (Malued, Dagupan City, Pangasinan) </em></small></label>
                                    <input type="text" class="form-control cap" name="address" placeholder="Barangay, City, Province" required>
                                </div>

                            </div>
                            <div class="row form-group">

                                <div class="col-md-6">
                                    <label for="" class="control-label">Profile Picture</label>
                                    <input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
                                    <img src="" alt="" id="cimg">

                                </div>
                                <div class="col-md-6">
                                    <label for="" class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>

                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="" class="control-label">Password</label>
                                    <input type="password" class="form-control thisPass" name="password" id="password" required>
                                </div>

                                <div class="col-md-6">
                             
                                    <label for="" class="control-label">Confirm Password</label><div class="text-danger ihide" id="error_match"></div>
                                    <input type="password" class="form-control thisPass" name="" id="confirm_password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">

                                        <input class="form-check-input" type="checkbox" value="" id="password_show">
                                        <label class="form-check-label ihide" for="password_show">
                                            Show password
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-left">
                                        <div class="text-danger empty_input my-3 ihide"></div>
                                        <div class="text-danger" id="length"><small class="length"></small></div>
                                        <div class="text-danger" id="upper"><small class="upper"></small></div>
                                        <div class="text-danger" id="lower"><small class="lower"></small></div>
                                        <div class="text-danger" id="num"><small class="num"></small></div>
                                        <div class="text-danger" id="sp"><small class="sp"></small></div>
                                    </div>
                                </div>
                            </div>

                            <div id="msg">

                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center mt-5">
                                    <button class="btn btn-primary">Create Account</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<footer style="background-color: #bcc2be;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 mt-4 mb-3">
                <img src="assets/img/upanglogo.png" style="width:100px">
            </div>

            <div class="col-lg-3 col-md-6 mt-4 mb-3">
                <ul class="list-unstyled mb-0">
                    <li class="mb-1">
                        <a href="index.php?page=about" style="color: #4f4f4f;">About</a>
                    </li>
                    <li class="mb-1">
                        <a href="index.php?page=careers" style="color: #4f4f4f;">Jobs</a>
                    </li>
                    <li class="mb-1">
                        <a href="#" style="color: #4f4f4f;">Terms & Conditions</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); color: #4f4f4f;">
        © 2022 Copyright: Ace Portal</div>

</footer>


<script>
    $('.datepickerY').datepicker({
        format: " yyyy",
        viewMode: "years",
        minViewMode: "years"
    })
    $('.select2').select2({
        placeholder: "Please Select Here",
        width: "100%"
    })

    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#cimg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#create_account').submit(function(e) {

        e.preventDefault()
        start_load()
        $.ajax({
            url: 'admin/ajax.php?action=signup',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: "JSON",
            success: function(resp) {

                if (resp.id == 1) {
                    alert_toast("An email will be sent if your account is verified. Please check your inbox.", "success");
                    //alert(email = $("#email").val());
                    $("#create_account")[0].reset();
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 1500);
                } else {
                    $('#msg').html('<div class="alert alert-danger">email already exist.</div>')
                    end_load()
                }
            }
        })
    })
</script>
<script>
    $(document).ready(function() {
        $("#batch").on("change", function() {
        
            var date = new Date();
            var cy = date.getFullYear();
            var y = $(this).val();
      
            if (y > cy) {
                $(this).val(date.getFullYear())
                $(".error_batch").text("Batch must not exceed to current year.")
                $("button").attr("disabled", true);
      
            } else {
                $(this).val(y)
                $(".error_batch").text("")
                $("button").attr("disabled", false);
           
            }

        });
        $("#batch").on("click", function() {
            var date = new Date();
            var cy = date.getFullYear();
            var y = $(this).val();
            console.log($(this).val())
            if (y > cy) {
                $(this).val(date.getFullYear())
                $(".error_batch").text("Batch must not exceed to current year.")
                $("button").attr("disabled", true);

            } else {
                $(this).val(date.getFullYear())
                $(".error_batch").text("")
                $("button").attr("disabled", false);
            }

        });



    })
</script>
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

    //password validation
    $(document).ready(function() {
        $(".form-check").click(function() {

            if ($("#password_show").prop("checked") == true) {
                $("input[type=password]").attr("type", "text")
            } else {
                $(".thisPass").attr("type", "password")
            }

        });

        $("#password").on("keyup", function() {
            let l = 1;
            let u = 1;
            let lo = 1;
            let n = 1;
            let s = 1;
            let np = $("#password").val();
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
            let np = $("#password").val();
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
</script>