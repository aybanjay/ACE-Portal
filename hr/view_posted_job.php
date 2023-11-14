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
                        <div class="container">
                        <?php include('layout/script.php') ?>
                            <?php

                            $sql = $conn->query("SELECT * FROM careers WHERE confirmed_at IS NOT NULL ORDER BY date_created DESC");

                            // $row = $sql->fetch_all(MYSQLI_ASSOC);
                            // $a = 0;
                            // foreach ($row as $key) {
                                $a = 0;
                                while($row=mysqli_fetch_assoc($sql)){
                            ?>

                                <div class="row">
                                    <div class="col-lg-12 py-2">
                                        <div class="card">
                                            <h5 class="card-header"><?= $row['company']; ?></h5>
                                
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $row['job_title']; ?></h5>
                                                <p></p>
                                      
                                                                                               
                                                 <?php    echo html_entity_decode($row['description']) ?>                                                                                                     
                                               

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

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
               
                if($(".dN").val()==""){
                    $(".err_d").text("This field is required")
                    alert($(".dN").val())
                }else{
                    $(".err_d").text("");
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
    <script>



    </script>

    </html>

<?php
} else {
    header('location: index.php');
}
?>