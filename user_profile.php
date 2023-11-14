<?php
include 'admin/db_connect.php';

$course_result = $conn->query('SELECT * FROM courses WHERE id = ' . $_SESSION['bio']['course_id'] . ' LIMIT 1');
$course = $course_result->num_rows > 0 ? $course_result->fetch_assoc() : null;

$applications_result = $conn->query('SELECT * FROM careers JOIN applicants ON applicants.career_id = careers.id WHERE applicants.user_id = ' . $_SESSION['login_id']);

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
</style>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="text-uppercase text-white font-weight-bold mt-5">
                <div class="col-lg-12 align-self-end mb-4">
                    <h3>User Profile</h3>
                </div>
            </div>

        </div>
    </div>
</header>
<div class="container mt-3 pt-2">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 shadow-lg">
                <img class="card-img-top mx-auto" src="/admin/assets/uploads/<?php echo $_SESSION['bio']['avatar']; ?>" alt="" style="width: 128px!important">
                <div class="card-body">
                    <p class="text-center">
                        <?php echo $_SESSION['login_name']; ?> <br />
                        <?php echo $course['course']; ?> <br />
                        <?php echo $_SESSION['bio']['batch']; ?> <br />
                        <?php echo $_SESSION['bio']['email']; ?> <br />
                        <?php echo $_SESSION['bio']['gender']; ?>




                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 shadow-lg">
                <div class="card-body">
                    <h4 class="card-title">My Applications</h4>
                    <table class="table table-condensed table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="">Company</th>
                                <th class="">Job Title</th>
                                <th class="">Date Applied</th>
                                <th class="">Application Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($applications_result->num_rows > 0) {
                                $i = 1;
                                while ($row = $applications_result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['company']; ?></td>
                                        <td><?php echo $row['job_title']; ?></td>
                                        <td><?php echo date('M d, Y h:i A', strtotime($row['date_applied'])); ?></td>
                                        <td><?php
                                            switch ($row['status']) {
                                                case 1:
                                                    $application_class = 'text-info';
                                                    $status = 'Shortlisted';
                                                    $vrb = "as of";
                                                    $date = date('M d, Y h:i A', strtotime($row['date_updated']));
                                                    break;
                                                case 2:
                                                    $application_class = 'text-warning';
                                                    $status = 'Interview';
                                                    $date = date('M d, Y h:i A', strtotime($row['date_interview']));
                                                    $vrb = "is on";
                                                    break;
                                                case 3:
                                                    $application_class = 'text-success';
                                                    $status = 'Hired';
                                                    $vrb = "as of";
                                                    $date = date('M d, Y h:i A', strtotime($row['date_updated']));
                                                    break;
                                                default:
                                                    $application_class = 'text-secondary';
                                                    $status = 'Pending';
                                                    $vrb = "";
                                                    $date = "";
                                                    break;
                                            }

                                            ?>
                                            <p> <b><span class="<?php echo $application_class; ?>"><?php echo $status; ?> </span> <?= $vrb; ?> <?php echo $date;  ?></b></p>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
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
    $('#update_account').submit(function(e) {
        e.preventDefault()
        start_load()
        $.ajax({
            url: 'admin/ajax.php?action=update_account',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Account successfully updated.", 'success');
                    setTimeout(function() {
                        location.reload()
                    }, 700)
                } else {
                    $('#msg').html('<div class="alert alert-danger">email already exist.</div>')
                    end_load()
                }
            }
        })
    })
</script>