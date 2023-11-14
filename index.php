<?php
session_start();
include('admin/db_connect.php');
ob_start();
$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
foreach ($query as $key => $value) {
  if (!is_numeric($key))
    $_SESSION['system'][$key] = $value;
}
ob_end_flush();
include('header.php');


?>
<!DOCTYPE html>
<html lang="en">


<style>
  #viewer_modal .btn-close {
    position: absolute;
    z-index: 999999;
    /*right: -4.5em;*/

    color: white;
    border: unset;
    font-size: 27px;
    top: 0;
  }

  #viewer_modal .modal-dialog {
    width: 80%;
    max-width: unset;
    height: calc(90%);
    max-height: unset;
  }

  #viewer_modal .modal-content {
    background: black;
    border: unset;
    height: calc(100%);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #viewer_modal img,
  #viewer_modal video {
    max-height: calc(100%);
    max-width: calc(100%);
  }

  body {
    background: white;
  }


  a.jqte_tool_label.unselectable {
    height: auto !important;
    min-width: 4rem !important;
    padding: 5px
  }

  .nav-link {
    font-family: 'Montserrat', sans-serif;
    ;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
  }

  .btnfont {
    font-family: sans-serif;
  }

  /*
a.jqte_tool_label.unselectable {
    height: 22px !important;
}*/
</style>

<body id="page-top">
  <!-- Navigation-->
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
  </div>

  <nav class="navbar navbar-dark navbar-expand-lg fixed-top py-0" style="background-color: #a3810f;">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="assets/img/logo.png" style="max-width: 200px;"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>

          <!-- if the user is not yet logged in, the jobs page is hidden -->
          <?php if (isset($_SESSION['login_id'])) {
            if ($_SESSION['login_type'] == 3) {
          ?>
              <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=careers">Jobs</a></li>
            <?php
            }
            ?>

          <?php
          } ?>



          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>



          <?php if (isset($_SESSION['login_id'])) {
            if ($_SESSION['login_type'] == 3) {  ?>
              <li class="nav-item">
                <div class=" dropdown mr-4">
                  <a href="#" class="nav-link js-scroll-trigger" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-angle-down"></i></a>
                  <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                    <a class="dropdown-item" href="index.php?page=user_profile" id="user_profile"><i class="fa fa-user"></i> User Profile</a>
                    <a class="dropdown-item" href="index.php?page=my_account" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                    <a class="dropdown-item" href="cv/index.php" id=""><i class="fas  fa-file"></i> Create CV</a>
                    <a class="dropdown-item" href="admin/ajax.php?action=logout2"><i class="fa fa-power-off"></i> Logout</a>
                  </div>
                </div>
              </li>
            <?php }
          } else {

            ?>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#" id="login">Login</a></li>
          <?php
          } ?>



        </ul>
      </div>
    </div>
  </nav>

  <?php
  $page = isset($_GET['page']) ? $_GET['page'] : "home";
  include $page . '.php';
  ?>


  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body">
          <div id="delete_content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="fa fa-arrow-righ t"></span>
          </button>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
        <img src="" alt="">
      </div>
    </div>
  </div>

  <div id="preloader"></div>



  <?php include('footer.php') ?>
</body>



<script type="text/javascript">
  $('#login').click(function() {
    uni_modal("Alumni Login", 'login.php')
  })
</script>

<?php $conn->close() ?>
<script>
  $(document).ready(function() {
    $("#frm_verify").on("submit", function(e) {
      e.preventDefault();
      $.ajax({
        url: "admin/action/verify_account_action.php",
        method: "POST",
        data: $(this).serialize(),
        dataType: "JSON",
        success: function(data) {
          if (data.statusCode == 200) {
            alert("Verifed")
            $("#verify_row").replaceWith('<div class="container py-5"><div class = "d-flex justify-content-center py-5" > <img src = "assets/img/verify_.png" class = "img-fluid w-25 h-25"alt = "..." ></div> <div class = "text-center" ><p class = "display-4" > Your account is now verified. Please <a href="index.php">Signin</> </p> </div> </div>');
          } else {
            alert("Account verification failed!");
          }
        }
      })
    })
  });
</script>

</html>