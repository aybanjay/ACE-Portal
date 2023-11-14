<?php

if (!isset($_GET['id']) && !isset($_GET['email'])) {
    header('location: /index.php');
    exit;
} else {
    $id = $_GET['id'];
    $email = $_GET['email'];

    $sql = $conn->query("SELECT id,email,status FROM alumnus_bio WHERE email='$email' AND id = '$id'");

    $row = $sql->fetch_assoc();


    if ($row == NULL) {

?>
        <div class="container py-5">
            <div class="d-flex justify-content-center py-5">
                <img src="assets/img/cancel.png" class="img-fluid w-25 h-25" alt="...">

            </div>
            <div class="text-center">
                <p class="display-4">Token is invalid. You will be redirected.</p>
            </div>
            <div class="text-center">
                <p class="display-3" id="count">5</p>
            </div>

        </div>

        <script>
            var timeleft = 5;

            function countdown() {
                timeleft--;
                document.getElementById("count").innerHTML = String(timeleft);
                if (timeleft > 0) {
                    setTimeout(countdown, 1000);
                }
                if (timeleft == 0) {
                    window.location.href = 'index.php'
                }
            };
            setTimeout(countdown, 1000);
        </script>

    <?php

    } else if ($row['status'] == 1) {
    ?>
        <div class="container py-5">
            <div class="d-flex justify-content-center py-5">
                <img src="assets/img/verify_.png" class="img-fluid w-25 h-25" alt="...">

            </div>
            <div class="text-center">
                <p class="display-4">Account already verified. You will be redirected.</p>
            </div>
            <div class="text-center">
                <p class="display-3" id="count_">5</p>
            </div>

        </div>

        <script>
            var timeleft = 5;

            function countdown() {
                timeleft--;
                document.getElementById("count_").innerHTML = String(timeleft);
                if (timeleft > 0) {
                    setTimeout(countdown, 1000);
                }
                if (timeleft == 0) {
                    window.location.href = 'index.php'
                }
            };
            setTimeout(countdown, 1000);
        </script>
    <?php
    } else {
    ?>


        <div class="container py-5">
            <div class="row py-5" id="verify_row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <form id="frm_verify">
                        <div class="card">
                            <img src="assets/img/verify.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <input type="hidden" value="<?php echo $row['id']; ?>" name="verify_id">
                                <input type="hidden" value="<?php echo $row['email']; ?>" name="verify_email">
                                <h5 class="card-title">Account Verification</h5>
                                <p class="card-text">We're excited to have you get started. First, you need to confirm your account. Just press the button below.</p>

                                <button type="submit" class="btn btn-warning btn-lg text-white btn-block">Confirm Account</button>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
<?php
    }
}
?>