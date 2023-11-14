<?php
session_start();
include('../admin/db_connect.php');
if (isset($_SESSION['login_id'])) {

?>

    <?php include('layout/header.php'); ?>
    <?php include_once('../admin/db_connect.php'); ?>
    <style>
        input[type="text"] {
            text-transform: capitalize;
        }
    </style>

    <body>
        <div class="container-scroller">
            <?php include('layout/navbar.php'); ?>
            <div class="container-fluid page-body-wrapper">

                <?php include('layout/sidebar.php'); ?>

                <div class="main-panel">
                    <div class="content-wrapper">


                        <?php //echo $_SESSION['bio']['id']; 
                        ?>
                        <div class="row px-5">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card px-5">
                                    <div class="card-body">
                                        <h4 class="card-title">Fill out the necessary details</h4>
                                        <p class="card-description"> Basic form layout </p>
                                        <form class="forms-sample" id="frmcv">
                                            <?php
                                            $id = $_SESSION['bio']['id'];
                                            $sql = $conn->query("SELECT * FROM alumnus_bio WHERE id = '$id'");
                                            $row = $sql->fetch_assoc();


                                            ?>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <h5 class="card-title">Personal details</h5>
                                                    <hr>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputUsername1">Full name</label>
                                                                <input type="text" class="form-control cap" id="fname" name="fname" value="<?php echo $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'];  ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Email address</label>
                                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Address</label>
                                                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Contact number</label>
                                                                <input type="text" class="form-control" id="cnumber" name="cnumber" placeholder="e.g 0989-098-2910">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Gender</label>
                                                                <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $row['gender']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <h5 class="card-title">Job history</h5>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">Job title</label>
                                                                <input type="text" class="form-control" id="job_title" name="job_title" placeholder="e.g Web Developer">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">Employer</label>
                                                                <input type="text" class="form-control" id="emp" name="emp" placeholder="e.g Accenture">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">Start date</label>
                                                                <input type="date" class="form-control" id="sdate" name="sdate">
                                                                <div class="text-danger sdate_error"></div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">End date</label>
                                                                <input type="date" class="form-control" id="edate" name="edate">
                                                                <div class="text-danger edate_error"></div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6"></div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <h5 class="card-title">Education</h5>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">Course</label>
                                                                <?php
                                                                $cid = $row['course_id'];
                                                                $qry = $conn->query("SELECT id, course FROM courses WHERE id='$cid'");
                                                                $srow = $qry->fetch_assoc();
                                                                ?>
                                                                <input type="text" class="form-control" id="course" name="course" value="<?php echo $srow['course']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">

                                                            <div class="form-group">

                                                                <label for="exampleInputConfirmPassword1">Batch</label>

                                                                <input type="text" class="form-control datePickerY" id="batch"  name="batch" value="">
                                                                <div class="text-danger"><small class="error_batch"></small></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row py-2">

                                                        <div class="col-md-12">
                                                            <h5 class="card-title">Character references </h5>
                                                            <p class="text-mute text-sm"> <small class=""> Please add three.</small></p>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">Full name</label>
                                                                <input type="text" class="form-control cap" id="cfname" name="cfname" placeholder="e.g Bill Gates">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">position</label>
                                                                <input type="text" class="form-control" id="position" name="position" placeholder="e.g Marketing">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">Contact number</label>
                                                                <input type="text" class="form-control" id="cn" name="cn" placeholder="e.g 0999-123-4567">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">Full name</label>
                                                                <input type="text" class="form-control cap" id="cfname2" name="cfname2" placeholder="e.g Elon Musk">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">position</label>
                                                                <input type="text" class="form-control" id="position2" name="position2" placeholder="e.g Programmer">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">Contact number</label>
                                                                <input type="text" class="form-control" id="cn2" name="cn2" placeholder="e.g 0999-123-4547">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">Full name</label>
                                                                <input type="text" class="form-control cap" id="cfname3" name="cfname3" placeholder="e.g Larry Page">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">position</label>
                                                                <input type="text" class="form-control" id="position3" name="position3" placeholder="e.g Data Analyst">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">Contact number</label>
                                                                <input type="text" class="form-control" id="cn3" name="cn3" placeholder="e.g 0999-123-4587">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">

                                                        <div class="col-md-12">
                                                            <h5 class="card-title">Skills </h5>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">
                                                                    Use comma (,) to separate each skills.
                                                                </label>
                                                                <textarea class="form-control" name="skills" id="" cols="30" rows="10" placeholder="e.g Web Development, Mobile App Development"></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row py-2">

                                                        <div class="col-md-12">
                                                            <h5 class="card-title">Tell us more about you. </h5>

                                                            <textarea name="objectives" id="" cols="10" rows="5" class="form-control"></textarea>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                                
                                            </div>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php include('layout/footer.php'); ?>

                </div>

            </div>

        </div>

    </body>
    <?php include('layout/script.php') ?>
    <link href="../admin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <script src="../admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script>
        $('.datePickerY').datepicker({
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"
        })
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
    <!-- Job date validation -->
    <script>
        $(document).ready(function() {
            $("#sdate").change(function() {

                var st = $("#sdate").val();
                var et = $("#edate").val();
                var TodayDate = new Date();
                var endDate = new Date(Date.parse(et));
                var startDate = new Date(Date.parse(st));

                if (endDate > TodayDate) {
                    $(".edate_error").text("Date must not exceed to current year.");
                    $("button").attr("disabled", true);
                } else if (startDate > TodayDate) {
                    $(".sdate_error").text("Date must not exceed to current year.");
                    $("button").attr("disabled", true);
                } else if (startDate > endDate) {
                    $(".sdate_error").text("Year range is invalid.");
                    $("button").attr("disabled", true);
                } else {
                    $(".sdate_error").text("");
                    $("button").attr("disabled", false);
                }


            });
            $("#edate").change(function() {

                var st = $("#sdate").val();
                var et = $("#edate").val();
                var TodayDate = new Date();
                var endDate = new Date(Date.parse(et));
                var startDate = new Date(Date.parse(st));

                if (endDate > TodayDate) {
                    $(".edate_error").text("Date must not exceed to current year.");
                    $("button").attr("disabled", true);
                } else if (startDate > endDate) {
                    $(".sdate_error").text("Year range is invalid.");
                    $("button").attr("disabled", true);
                } else {
                    $(".edate_error").text("");
                    $(".sdate_error").text("");
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
        // $(document).ready(function() {
        //     $("#batch").on("keyup", function() {
        //         var date = new Date();
        //         var cy = date.getFullYear();
        //         var y = $(this).val();
        //         console.log($(this).val())
        //         if (y > cy) {
        //             $(this).val(date.getFullYear())
        //             $(".error_batch").text("Batch must not exceed to current year.")
        //         } else {
        //             $(".error_batch").text("")
        //         }

        //     });
        // });
    </script>
    <script>
        $(document).ready(function() {
            $("#frmcv").on("submit", function(e) {
                e.preventDefault();
                console.log($(this).serialize());

                $.ajax({
                    url: "action/cv_action.php",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(data) {
                        if (data.statusCode == 200) {
                            toastr["success"]("You have successfully created your cv.", "Congratulations");
                        } else {
                            toastr["error"]("Error creating cv. Please refresh the page.", "Error");
                        }
                    }
                })
            })
        })
    </script>
<?php
} else {
    header('location: ../index.php');
}

?>