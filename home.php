<?php
include 'admin/db_connect.php';
?>
<style>
  body {
    background-color: #fafafa;
  }

  .events {
    transition: all 0.3 ease;
  }

  .events:hover {
    transform: translateY(-20px);
  }
</style>
<div class="hero-container min-vh-100">
  <div class=" p-5 text-center bg-image vh-100" style="background-image: linear-gradient(160deg, rgb(0 0 0 / 13%),rgb(0, 0, 0)),url('assets/img/upang.jpg'); background-size: cover;
 background-repeat: no-repeat; height: 650px;">
    <div class="row py-5">
      <div class="col-lg-12">
        <div class="mask shadow-lg p-3 mb-5 rounded" style="box-shadow: 0 1rem 3rem #0c0c0c !important;background-color: rgba(0, 0, 0, 0.4); height: 400px; border-radius: 3%;">
          <div class="d-flex align-items-center h-100">
            <div class="welcome-message text-white">
              <h1 class="mb-2 mt-5 mx-3 text-left" style="font-weight: 500;  font-size: 60px;">ACE Portal</h1>

              <p class="display-4 text-muted mx-3 text-left" style="font-size: 30px;">Welcome PHINMA - UPANG Professionals. Connects you, as a graduate from your University.

              </p>


            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- Hero -->
<!-- <div class="hero-container mt-5">
<div class="p-5 text-center bg-image" style= "background-image: url('assets/img/upang.jpg'); background-size: cover;
 background-repeat: no-repeat; height: 650px;">
  <div class="mask mt-5" style="background-color: rgba(0, 0, 0, 0.4); height: 400px;">
    <div class="d-flex justify-content-center align-items-center h-100">
      <div class="welcome-message text-white">
        <h1 class="mb-5 mt-5" style="font-family: 'Anton', sans-serif; font-weight: 500;  font-size: 80px;">Welcome to Ace Portal</h1>
        
        
      </div>
    </div>
  </div>
</div>
</div> -->
<!-- Hero -->

<!--- Events --->

<div class="d-flex justify-content-center align-items-center mt-5">

  <h3 style="font-family: 'Anton', sans-serif; font-weight: 500;">Events</h3>
</div>

<div class="events-container mt-3 mb-5 px-4 overflow-hidden">
  <div class="row gx-5">

    <div class="col-md-4 events" id="events-card">
      <div class="card mb-3 shadow" style="max-width: 540px; height: 650px;">
        <div class="row no-gutters">
          <div class="col-md-12">
            <img src="assets/img/webdev.jpg" class="card-img" alt="..." style="height: 300px;">
          </div>
          <div class="col-md-12">
            <div class="card-body">
              <h3 class="card-title">Mobile Application Developer</h3>
              <p class="card-text">Fresh Graduate/Entry level specializing in IT/Computer - Software Development or equivalent.</p>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class=" col-md-4 events">
      <div class="card mb-3 shadow" style="max-width: 540px; height: 650px;">
        <div class="row no-gutters">
          <div class="col-md-12">
            <img src="assets/img/nurse.jpg" class="card-img" alt="..." style="height: 300px;">
          </div>
          <div class="col-md-12">
            <div class="card-body">
              <h3 class="card-title">Staff Nurse</h3>
              <p class="card-text">Candidate must possess at least a Bachelor’s/College Degree on Nursing.</p>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class=" col-md-4 events">
      <div class="card mb-3 shadow" style="max-width: 540px; height: 650px;">
        <div class="row no-gutters">
          <div class="col-md-12">
            <img src="assets/img/civilengineer.jpg" class="card-img" alt="..." style="height: 300px;">
          </div>
          <div class="col-md-12">
            <div class="card-body">
              <h3 class="card-title">Architect</h3>
              <p class="card-text">We are hiring experts in designing houses.</p>

            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>


<!-- FOOTER --->
<footer style="background-color: #bcc2be;">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-12 mt-4 mb-3">
        <img src="assets/img/upanglogo.png" style="width:100px">
      </div>

      <div class="col-lg-3 col-md-6 mt-4 mb-3">
        <ul class="list-unstyled mb-0">
          <?php if (isset($_SESSION['login_id'])) : ?>
            <li class="mb-1">
              <a href="index.php?page=careers" style="color: #4f4f4f;">Jobs</a>
            </li> <?php endif; ?>
          <li class="mb-1">
            <a href="index.php?page=about" style="color: #4f4f4f;">About</a>
          </li>

          <li class="mb-1">
            <a href="#" style="color: #4f4f4f;">Terms & Conditions</a>
          </li>
        </ul>
      </div>

    </div>
  </div>
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); color: #4f4f4f;">
    © 2022 Copyright: ACE Portal</div>

</footer>



<script>
  $('.read_more').click(function() {
    location.href = "index.php?page=view_event&id=" + $(this).attr('data-id')
  })
  $('.banner img').click(function() {
    viewer_modal($(this).attr('src'))
  })
  $('#filter').keyup(function(e) {
    var filter = $(this).val()

    $('.card.event-list .filter-txt').each(function() {
      var txto = $(this).html();
      txt = txto
      if ((txt.toLowerCase()).includes((filter.toLowerCase())) == true) {
        $(this).closest('.card').toggle(true)
      } else {
        $(this).closest('.card').toggle(false)

      }
    })
  })
</script>