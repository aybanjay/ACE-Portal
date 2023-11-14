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
    .cap{
        text-transform: capitalize;
    }
</style>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="text-uppercase text-white font-weight-bold mt-5">
                <div class="col-lg-12 align-self-end mb-4">
                    <h3>Manage Account</h3>
                </div>
            </div>

        </div>
    </div>
</header>
<div class="container mt-3 pt-2">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body shadow-lg">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <form action="" id="update_account">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="" class="control-label">Last Name</label>
                                    <input type="text" class="form-control cap" name="lastname" value="<?php echo $_SESSION['bio']['lastname'] ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">First Name</label>
                                    <input type="text" class="form-control cap" name="firstname" value="<?php echo $_SESSION['bio']['firstname'] ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">Middle Name</label>
                                    <input type="text" class="form-control cap" name="middlename" value="<?php echo $_SESSION['bio']['middlename'] ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="" class="control-label">Gender</label>
                                    <select class="custom-select" name="gender" required>
                                        <option <?php echo $_SESSION['bio']['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                        <option <?php echo $_SESSION['bio']['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">Batch</label>
                                    <input type="input" class="form-control datepickerY" id="batch" name="batch" value="<?php echo $_SESSION['bio']['batch'] ?>" required>
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
                                            <option value="<?php echo $row['id'] ?>" <?php echo $_SESSION['bio']['course_id'] == $row['id'] ? 'selected' : '' ?>><?php echo $row['course'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="" class="control-label">Address <small> <em> e.g (Malued, Dagupan City, Pangasinan) </em></small></label>
                                    <input type="text" class="form-control cap" name="address" value="<?php echo $_SESSION['bio']['address'] ?>" required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="" class="control-label">Profile Picture</label>
                                    <input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
                                    <img src="" alt="" id="cimg">

                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['bio']['email'] ?>" required>
                                </div>
                                <div class="col-md-4" style="display: none;">
                                    <label for="" class="control-label">Password</label>
                                    <input type="password" class="form-control" name="password" >
                                    <small><i>Leave this blank if you dont want to change your password</i></small>
                                </div>
                            </div>
                            <div id="msg">

                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center mt-5">
                                    <button class="btn btn-primary" id="btn_up">Update Account</button>
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
        $("#batch").on("change", function() {
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
    $('#update_account').submit(function(e) {
        e.preventDefault()
      //  start_load()
        $.ajax({
            url: 'admin/ajax.php?action=update_account',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            beforeSend: function(){
                $("#btn_up").html("Updating...")
            },
            success: function(resp) {
                if (resp == 1) {
                    setTimeout(function(){
                        $("#btn_up").html("Update")
                    },800)
                    setTimeout(function(){
                        alert_toast("Account successfully updated. You will be redirected. Please login!", 'success');
                    },1500)
                    setTimeout(function() {
                        window.location.href = 'index.php'
                    }, 2500)
                } else {
                    $('#msg').html('<div class="alert alert-danger">email already exist.</div>')
                    end_load()
                }
            }
        })
    })
</script>