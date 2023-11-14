<?php
session_start();

if (isset($_SESSION['email']) && isset($_SESSION['id']) && isset($_SESSION['name'])) {


?>

    <?php include('layout/header.php'); ?>
    <?php include_once('../admin/db_connect.php'); ?>

    <body>
        <div class="container-scroller">
            <?php include('layout/navbar.php'); ?>
            <div class="container-fluid page-body-wrapper">

                <?php include('layout/sidebar.php'); ?>

                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">List of applicants</h4>
                                        <p class="card-description">Manage
                                        </p>
                                        <div class=" table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th class="">Avatar</th>
                                                        <th class="">Name</th>
                                                        <th class="">Course Graduated</th>
                                                        <th class="">Job Applied for</th>
                                                        <th class="">Application Status</th>
                                                        <th class="text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $alumni = $conn->query('SELECT users.id as user_id, alumnus_bio.*,alumnus_bio.id as alid, courses.course, CONCAT(alumnus_bio.lastname,", ",alumnus_bio.firstname," ",alumnus_bio.middlename) as `name`, applicants.date_interview as idate, applicants.status as application_status, applicants.date_updated, careers.job_title, careers.id as job_id FROM applicants JOIN careers ON careers.id = applicants.career_id JOIN users ON users.id = applicants.user_id JOIN alumnus_bio ON alumnus_bio.id = users.alumnus_id JOIN courses ON courses.id =  alumnus_bio.course_id WHERE careers.user_id = ' . $_SESSION['id'] . ' ORDER BY CONCAT(alumnus_bio.lastname,", ",alumnus_bio.firstname," ",alumnus_bio.middlename) ASC');
                                                    if ($alumni->num_rows > 0) {
                                                        $i = 1;

                                                        while ($row = $alumni->fetch_assoc()) :

                                                    ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $i++ ?></td>
                                                                <td class="text-center">
                                                                    <div class="avatar">
                                                                        <img src="assets/uploads/<?php echo $row['avatar'] ?>" class="" alt="">
                                                                    </div>
                                                                </td>
                                                                <td class="">
                                                                    <p> <b><?php echo ucwords($row['name']) ?></b></p>
                                                                </td>
                                                                <td class="">
                                                                    <p> <b><?php echo $row['course'] ?></b></p>
                                                                </td>
                                                                <td class="text-center">
                                                                    <p> <b><?php echo $row['job_title'] ?></b></p>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    switch ($row['application_status']) {
                                                                        case 1:
                                                                            $application_class = 'text-info';
                                                                            $application_status = 'Shortlisted';
                                                                            $vrb = "as of";
                                                                            $date = date('M d, Y h:i A', strtotime($row['date_updated']));
                                                                            break;
                                                                        case 2:
                                                                            $application_class = 'text-warning';
                                                                            $application_status = 'Interview';
                                                                            $date = date('M d, Y h:i A', strtotime($row['idate']));
                                                                            $vrb = "is on";
                                                                            break;
                                                                        case 3:
                                                                            $application_class = 'text-success';
                                                                            $application_status = 'Hired';
                                                                            $vrb = "as of";
                                                                            $date = date('M d, Y h:i A', strtotime($row['date_updated']));
                                                                            break;
                                                                        default:
                                                                            $application_class = 'text-secondary';
                                                                            $application_status = 'Pending';
                                                                            $vrb = "";
                                                                            $date = "";
                                                                            break;
                                                                    }

                                                                    ?>
                                                                    <p> <b><span class="<?php echo $application_class; ?>"><?php echo $application_status; ?> </span> <?= $vrb; ?> <?php echo $date;  ?></b></p>
                                                                </td>
                                                                <td class="text-center">

                                                                    <div class="dropdown">
                                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            Action
                                                                        </button>
                                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                            <?php if (!$row['application_status']) { ?>
                                                                                <li><a class="dropdown-item btn_alumni_action shortlist_alumni" data-id="<?php echo $row['user_id'] ?>" data-status="1" data-career_id="<?php echo $row['job_id']; ?>" href="#">Shortlist</a></li>
                                                                            <?php } else if ($row['application_status'] == 1) { ?>
                                                                                <li><a class="dropdown-item  interview_alumni" data-id="<?php echo $row['user_id'] ?>" data-status="2" data-career_id="<?php echo $row['job_id']; ?>" href="#">Interview</a></li>
                                                                            <?php } else if ($row['application_status'] == 2) { ?>
                                                                                <li><a target="_blank" class="dropdown-item hire_alumni" data-id="<?php echo $row['user_id'] ?>" data-status="3" data-career_id="<?php echo $row['job_id']; ?>" href="#">Hire</a></li>
                                                                            <?php }  ?>
                                                                            <li><a class="dropdown-item view_alumni" data-id="<?php echo $row['alid'] ?>" href="#">View</a></li>
                                                                            <li><a class="dropdown-item view_cv" data-id="<?php echo $row['alid'] ?>" href="#">Curriculum Vitae</a></li>
                                                                        </ul>
                                                                    </div>

                                                                </td>
                                                                <td>

                                                                </td>
                                                            </tr>
                                                    <?php endwhile;
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php include('layout/footer.php'); ?>

                </div>



            </div>

        </div>

        </div>
        <?php include('modal/post_modal.php'); ?>
        <?php include('../company/modal/interview_date.php'); ?>
        <?php include('modal/view_alumni_modal.php'); ?>
    </body>
    <?php include('layout/script.php') ?>
    <!-- View CV -->
    <script>
        $('.text-jqte').jqte();
    </script>
    <script>
        $(document).on("click", ".view_cv", function() {

            window.open('../company/view_cv.php?id=' + $(this).data("id"), '_blank')

        })
    </script>

    <script>
        (function() {
            emailjs.init("wbHWxY4JCd8YgpQ82");
        })();
    </script>
    <script>
        $(document).on("click", ".interview_alumni", function() {
            let uid = $(this).data("id");
            let status = $(this).data("status");
            let cid = $(this).data("career_id");

            $("#interview_modal").modal("show")
            $("#btnset").click(function() {
                let idate = $("#idate").val()

                if (idate == "") {
                    $("._emsg").text("Set a valid date.")
                } else {

                    $.ajax({
                        url: "../company/action/interview_action.php",
                        method: "POST",
                        data: {
                            uid: uid,
                            cid: cid,
                            idate: idate
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == 200) {
                                console.log(true)
                                $.ajax({
                                    url: "../company/action/fetch_email.php",
                                    method: "POST",
                                    data: {
                                        uid: uid,
                                        cid: cid,
                                        idate: idate
                                    },
                                    dataType: "JSON",
                                    success: function(data) {
                                        var company = data.company
                                        var email = data.umail
                                        var iname = data.iname

                                        var templateParams = {
                                            idate: idate,
                                            company: company,
                                            iname: iname,
                                            email: email,

                                        };

                                        emailjs.send('service_hld33hj', 'template_2qmc856', templateParams)
                                            .then(function(response) {
                                                console.log('SUCCESS!', response.status, response.text);

                                                $("#interview_modal").modal("hide")
                                                toastr["success"]("The applicant has been notified","Email sent.")
                                                setTimeout(function() {
                                                    location.reload()
                                                }, 2000)
                                            }, function(error) {
                                                console.log('FAILED...', error);
                                                alert_toast("Error occured in this action! Please4 refresh the page.", "error")
                                            });
                                    }
                                })
                            } else {
                                console.log(false)
                            }
                        }
                    })
                }
            })


        });
    </script>
    <script>
        $(document).on("click", ".hire_alumni", function() {
            let career_id = $(this).data("career_id")
            let user_id = $(this).data("id")
            $.ajax({
                url: "../company/action/hire_action.php",
                method: "POST",
                data: {
                    career_id: career_id,
                    user_id: user_id
                },
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 200) {
                        alert_toast('Applicant hired!', 'success')
                        setTimeout(function() {
                            location.reload()
                        }, 1500)
                    } else {
                        alert_toast('Something wrong. Please refresh the page.', 'danger')
                    }
                }
            })
        })
    </script>
    <script>
        $(document).on("click", ".view_alumni", function() {
            var id = $(this).data("id");
            $.ajax({
                url: "action/view_alumni_fetch.php",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(data) {
                    $("#lname").text(data.name);
                    $("#lemail").text(data.email);
                    $("#lbatch").text(data.batch);
                    $("#lcourse").text(data.course);
                    $("#lgender").text(data.gender);
                    $("#view_alumni").modal("show")
                }
            })

        })
    </script>
    <script>
        $('.btn_alumni_action').click(function(e) {

            e.preventDefault();
            start_load();
            $.ajax({
                url: '../company/ajax.php?action=alumni-action',
                method: 'POST',
                data: {
                    id: $(e.currentTarget).data('id'),
                    status: $(e.currentTarget).data('status'),
                    career_id: $(e.currentTarget).data('career_id'),
                },
                success: function(resp) {
                    if (resp == 1) {

                        location.reload();
                    } else {
                        alert_toast("Oops! Something went wrong!", 'danger');
                    }
                },

                error: function(err) {
                    alert_toast("Oops! Something went wrong!", 'danger');
                },
                complete: function() {
                    end_load();
                }
            });
        });
    </script>
    <script>
        window.start_load = function() {
            $('body').prepend('<di id="preloader2"></di>')
        }
        window.end_load = function() {
            $('#preloader2').fadeOut('fast', function() {
                $(this).remove();
            })
        }
        window.viewer_modal = function($src = '') {
            start_load()
            var t = $src.split('.')
            t = t[1]
            if (t == 'mp4') {
                var view = $("<video src='" + $src + "' controls autoplay></video>")
            } else {
                var view = $("<img src='" + $src + "' />")
            }
            $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
            $('#viewer_modal .modal-content').append(view)
            $('#viewer_modal').modal({
                show: true,
                backdrop: 'static',
                keyboard: false,
                focus: true
            })
            end_load()

        }
        window.uni_modal = function($title = '', $url = '', $size = "") {
            start_load()
            $.ajax({
                url: $url,
                error: err => {
                    console.log()
                    alert("An error occured")
                },
                success: function(resp) {
                    if (resp) {
                        $('#uni_modal .modal-title').html($title)
                        $('#uni_modal .modal-body').html(resp)
                        if ($size != '') {
                            $('#uni_modal .modal-dialog').addClass($size)
                        } else {
                            $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                        }
                        $('#uni_modal').modal({
                            show: true,
                            backdrop: 'static',
                            keyboard: false,
                            focus: true
                        })
                        end_load()
                    }
                }
            })
        }
        window._conf = function($msg = '', $func = '', $params = []) {
            $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
            $('#confirm_modal .modal-body').html($msg)
            $('#confirm_modal').modal('show')
        }
        window.alert_toast = function($msg = 'TEST', $bg = 'success') {
            $('#alert_toast').removeClass('bg-success')
            $('#alert_toast').removeClass('bg-danger')
            $('#alert_toast').removeClass('bg-info')
            $('#alert_toast').removeClass('bg-warning')

            if ($bg == 'success')
                $('#alert_toast').addClass('bg-success')
            if ($bg == 'danger')
                $('#alert_toast').addClass('bg-danger')
            if ($bg == 'info')
                $('#alert_toast').addClass('bg-info')
            if ($bg == 'warning')
                $('#alert_toast').addClass('bg-warning')
            $('#alert_toast .toast-body').html($msg)
            $('#alert_toast').toast({
                delay: 3000
            }).toast('show');
        }
        $(document).ready(function() {
            $('#preloader').fadeOut('fast', function() {
                $(this).remove();
            })
        })
        $('.datetimepicker').datetimepicker({
            format: 'Y/m/d H:i',
            startDate: '+3d'
        })
        $('.select2').select2({
            placeholder: "Please select here",
            width: "100%"
        })
    </script>

    </html>
<?php
} else {
    header('location: index.php');
}
?>