<?php
session_start();
include_once('../admin/db_connect.php');
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
                        <?php if (isset($_SESSION['message'])) { ?>
                            <div class="alert alert-success tm">
                                <?php
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                                ?>
                            </div>
                        <?php  } ?>
                        <div class="row">


                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Jobs you posted</h4>
                                        <p class="card-description">Manage
                                        </p>
                                        <div class=" table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Company</th>
                                                        <th>Location</th>
                                                        <th>Description</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $uid = $_SESSION['id'];
                                                    $sql = $conn->query("SELECT * FROM careers WHERE user_id = '$uid' ORDER BY date_created DESC");
                                                    $row = $sql->fetch_all(MYSQLI_ASSOC);

                                                    foreach ($row as $key) {
                                                    ?>

                                                        <tr>
                                                            <td><?= $key['job_title']; ?></td>
                                                            <td><?= $key['company']; ?></td>
                                                            <td><?= $key['location']; ?></td>
                                                            <td><?= $key['description']; ?></td>
                                                            <td><?php
                                                                if ($key['confirmed_at'] == NULL) {
                                                                    echo '<label class="badge badge-danger">Pending</label>';
                                                                } else {
                                                                    echo '<label class="badge badge-success">Posted</label>';
                                                                }

                                                                ?></td>
                                                            <td>
                                                                <?php
                                                                if ($key['confirmed_at'] == NULL) {
                                                                ?>
                                                                    <button type="button" class="btn btn-outline-warning edit btn-sm btn-icon-text" data-id="<?= $key['id']; ?>"> Edit <i class="mdi mdi-file-check btn-icon-append"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-outline-danger delete btn-sm btn-icon-text" data-id="<?= $key['id']; ?>"> Delete <i class="mdi mdi-alert btn-icon-append"></i>
                                                                    </button>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <button type="button" class="btn btn-outline-danger delete btn-sm btn-icon-text" data-id="<?= $key['id']; ?>"> Delete <i class="mdi mdi-alert btn-icon-append"></i>
                                                                    </button>
                                                                <?php
                                                                }
                                                                ?>

                                                            </td>

                                                        </tr>

                                                    <?php
                                                    }

                                                    ?>
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
                    alert($(".dN").val())
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


                                location.reload()
                                // toastr['success']("Job has been posted! The page will refresh a moment.", "Successful");
                            } else {
                                toastr['danger']("Problem occured! Please try again..", "Error");

                            }
                        }

                    })
                }
            })

        })
    </script>
    <script>
        $(document).on("click", ".edit", function() {
            var id = $(this).data("id");
            alert(id)
            $.ajax({
                url: "action/post_fetch.php",
                method: "POST",
                data: {
                    type: 1,
                    id: id
                },
                dataType: "JSON",
                success: function(data) {
                    $("#hidden_id").val(data.id);
                    $("#edit_company").val(data.company);
                    $("#edit_job_title").val(data.job_title);
                    $("#edit_location").val(data.location);
                    $(".jqte_editor").append(data.description);
                    $("#post_update").modal("show");
                }
            })

        });
        $(document).ready(function() {
            $("#frmpost_update").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "action/post_action_update.php",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "JSON",

                    success: function(data) {
                        if (data.statusCode == 200) {
                            $("#post_update").modal("hide");
                            setTimeout(function() {
                                toastr['success']("Applying changes..");
                            }, 200);

                            setTimeout(function() {
                                toastr['success']("Job has been updated.", "Successfull");
                            }, 2000);
                            setTimeout(function() {
                                window.location.reload()
                            }, 3000)
                        } else {
                            toastr['error']("Error action.", "Error");
                        }
                    }
                })
            })
        })
    </script>
    <script>
        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");
            $.ajax({
                url: "action/post_action_delete.php",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(data) {
                    if (data.statusCode == 200) {
                        setTimeout(function() {
                            toastr['success']("Post removed..The page will refresh.");
                        }, 200);
                        setTimeout(function() {
                            window.location.reload()
                        }, 2000)
                    } else {
                        toastr['error']("Error action.", "Error");
                    }
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