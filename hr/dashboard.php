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


                        <div class="page-header">
                            <h3 class="page-title">
                                <span class="page-title-icon bg-gradient-primary text-white me-2">
                                    <i class="mdi mdi-home"></i>
                                </span> Dashboard
                            </h3>
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <div class="row">
                            <div class="col-md-4 stretch-card grid-margin">
                                <div class="card bg-gradient-danger card-img-holder text-white">
                                    <div class="card-body">
                                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                                        <h2 class="font-weight-normal mb-3">Applicants <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                                        </h2>
                                        <?php


                                        $q = $conn->query("SELECT applicants.career_id AS aid, applicants.status AS st, careers.id AS cid, careers.company AS comp FROM careers LEFT JOIN applicants ON applicants.career_id = careers.id
    WHERE careers.user_id = '$_SESSION[id]'  AND applicants.career_id is NOT NULL
    ; ");
                                        ?>
                                        <h1 class="mb-5"><?php echo $q->num_rows; ?></h1>
                                        <!-- <h6 class="card-text">Increased by 60%</h6> -->




                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 stretch-card grid-margin">
                                <div class="card bg-gradient-info card-img-holder text-white">
                                    <div class="card-body">
                                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                                        <h2 class="font-weight-normal mb-3">Posted Jobs <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                                        </h2>

                                        <h1 class="mb-5"> <?php echo $conn->query("SELECT * FROM careers WHERE user_id = " . $_SESSION['id'])->num_rows; ?></h1>
                                        <!-- <h6 class="card-text">Decreased by 10%</h6> -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php include('layout/footer.php'); ?>

                </div>

            </div>

        </div>
        <?php include('modal/post_modal.php'); ?>
    </body>
    <?php include('layout/script.php') ?>
    <script>
        $('.text-jqte').jqte();
    </script>
    <script>
        $(document).ready(function() {
            $("#frmpost").on("submit", function(e) {
                e.preventDefault();
                if ($(".dN").val() == "") {
                    $(".err_d").text("This field is required")
                    
                } else {
                    $.ajax({
                        url: "action/post_action.php",
                        method: "POSt",
                        data: $(this).serialize(),
                        dataType: "JSON",
                        beforeSend: function() {
                            $("button#create").text("Creating..")
                            $("#_jobhead").text("Job is posting...")
                            $("button#create").attr("disabled", "disabled");
                        },
                        success: function(data) {
                            if (data.statusCode == 200) {
                                $("#post").modal("hide");
                                toastr['success']("Wait for the admin to confirm the job you are posting.", "Successful");
                                setTimeout(function() {
                                    location.reload()
                                }, 2000)
                            } else {
                                toastr['danger']("Problem occured! Please try again..", "Error");
                            }
                        }

                    })
                }
            })
        })
    </script>

    </html>
<?php
} else {
    header('location: index.php');
}
?>