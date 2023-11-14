<?php
session_start();
include('../admin/db_connect.php');
if (isset($_SESSION['login_id'])) {

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
                                        <h4 class="card-title">Your resume</h4>
                                        <p class="card-description">Manage
                                        </p>
                                        <div class=" table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $uid = $_SESSION['login_id'];
                                                    $qry = $conn->query("SELECT id, alumnus_id FROM users WHERE id = '$uid'");

                                                    $srow = $qry->fetch_assoc();

                                                    $aid =  $srow['alumnus_id'];

                                                    $sql = $conn->query("SELECT user_id, status, id FROM cv WHERE user_id = '$aid'");
                                                    $row = $sql->fetch_all(MYSQLI_ASSOC);

                                                    foreach ($row as $key) {
                                                    ?>

                                                        <tr>
                                                            <td><?php
                                                                if ($key['status'] == 1) {
                                                                    echo '<label class="badge badge-success">Active</label>';
                                                                } else {
                                                                    echo '<label class="badge badge-danger">inactive</label>';
                                                                }

                                                                ?></td>
                                                            <td>
                                                                <?php
                                                                if ($key['status'] == 1) {
                                                                ?>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            Action
                                                                        </button>
                                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                                                            <li><a target="_blank" class="dropdown-item view" data-user="<?php echo $key['user_id']; ?>" data-id="<?php echo $key['id']; ?>" href="#">View</a></li>
                                                                            <li><a class="dropdown-item edit_cv" data-id="<?php echo $key['id']; ?>" href="#">Edit</a></li>
                                                                            <li><a class="dropdown-item delete" data-id="<?php echo $key['id']; ?>" href="#">Delete</a></li>
                                                                        </ul>
                                                                    </div>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            Action
                                                                        </button>
                                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                            <li><a class="dropdown-item act" data-user="<?php echo $key['user_id']; ?>" data-id="<?php echo $key['id']; ?>" href="#">Active</a></li>
                                                                            <li><a class="dropdown-item edit_cv" data-id="<?php echo $key['id']; ?>" href="#">Edit</a></li>
                                                                            <li><a target="_blank" class="dropdown-item view" data-id="<?php echo $key['id']; ?>" href="#">View</a></li>
                                                                            <li><a class="dropdown-item delete" data-id="<?php echo $key['id']; ?>" href="#">Delete</a></li>
                                                                        </ul>
                                                                    </div>
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
                    <?php include('modal/edit_modal.php'); ?>
                    <?php include('layout/footer.php'); ?>

                </div>

            </div>

        </div>

    </body>
    <?php include('layout/script.php') ?>
    <script>
        $(document).on("click", ".view", function() {
            let id = $(this).data("id")
            window.open('view.php?id=' + id, '_blank')
            //window.location.href = 'view.php?id=' + id;
        })
    </script>
    <script>
        $(document).on("click", ".edit_cv", function() {
            let id = $(this).data("id")
            $("#edit_modal").modal("show");
            $.ajax({
                url: "action/edit_cv.php",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(data) {
                    $("#hidden_id_update").val(data.id);
                    $("#job_title").val(data.job_title);
                    $("#emp").val(data.emp);
                    $("#cnumber").val(data.contact);
                    $("#sdate").click(function() {
                        $("#sdate").replaceWith('<input type="date" class="form-control" id="sdate" name="sdate">')
                    })
                    $("#sdate").val(data.sdate);
                    $("#edate").click(function() {
                        $("#edate").replaceWith('<input type="date" class="form-control" id="edate" name="edate">')
                    })
                    $("#edate").val(data.edate);
                    var arr_ref_1 = data.ref_1.split(",");
                    // console.log(arr_ref_1)
                    $("#cfname").val(arr_ref_1[0]);
                    $("#position").val(arr_ref_1[1]);
                    $("#cn").val(arr_ref_1[2]);

                    var arr_ref_2 = data.ref_2.split(",");
                    // console.log(arr_ref_2)
                    $("#cfname2").val(arr_ref_2[0]);
                    $("#position2").val(arr_ref_2[1]);
                    $("#cn2").val(arr_ref_2[2]);

                    var arr_ref_3 = data.ref_3.split(",");
                    // console.log(arr_ref_3)
                    $("#cfname3").val(arr_ref_3[0]);
                    $("#position3").val(arr_ref_3[1]);
                    $("#cn3").val(arr_ref_3[2]);

                    $("#skills").val(data.skills);
                    $("#objectives").val(data.objectives);
            
                }
            })
        })
    </script>
        <script>
        $(document).ready(function(){
            $("#frmcv_update").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: "action/edit_cv_action.php",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(data){
                        if(data.status==200){
                            toastr['success']("Curriculum vitae updated.","Successful")
                            setTimeout(function(){
                                location.reload();
                            },1500)
                        }else{
                            toastr['error']("An error occured updating curriculum vitae.","Error")
                        }
                    }
                })
            })
        })
    </script>
    <script>
        $(document).on("click", ".delete", function() {
            let id = $(this).data("id")

            $.ajax({
                url: "action/delete_cv.php",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(data) {
                    if (data.statusCode == 200) {
                        toastr['success']("Cv Deleted", "Successfull");
                        setTimeout(function() {
                            location.reload()
                        }, 1500)
                    } else {
                        toastr['error']("Somethin went wrong", "Error");
                    }

                }
            })
        })
    </script>
    <script>
        $(document).on("click", ".act", function() {
            let id = $(this).data("id")
            let user = $(this).data("user");
        

            $.ajax({
                url: "action/active_cv.php",
                method: "POST",
                data: {
                    id: id,
                    user: user
                },
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 200) {
                        toastr['success']("Posted CV has been changed.", "Successful");
                        setTimeout(function() {
                            location.reload()
                        }, 1500)
                    } else {
                        toastr['error']("Somethin went wrong", "Error");
                    }

                }
            })
        })
    </script>

<?php
} else {
    header('location: ../index.php');
}

?>