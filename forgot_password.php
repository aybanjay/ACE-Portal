<!-- <div class="container" style="margin-top: 250px">
    <div class="text-success msg"></div>
    <div class="card w-50 mx-auto">
        <div class="card-body">
            <h4>Forgot Password</h4>
            <form id="form-forgot-password">
                <div class="form-group">
                    <input type="email" name="email" required="" id="email" class="form-control" placeholder="Enter your email address">
                </div>
                <button type="submit" id="forgot-password" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div> -->


<div class="form-gap" style="padding-top:100px;"></div>
<div class="container py-5 mx-auto">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">

                            <form id="form-forgot-password" role="form" autocomplete="off" class="form">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="recover-submit" id="forgot-password" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                </div>

                                <!-- <input type="hidden" class="hide" name="token" id="token" value=""> -->
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<script>
    (function() {
        emailjs.init("user_NTdHCA9zp9sC7gmz1ncCT");
    })();
    // var templateParams = {
    //     name: 'James',
    //     notes: 'Check this out!',
    //     email: 'chandelier222999@gmail.com'
    // };
    // $("#forgot-password").click(function() {
    //     $(this).attr("disabled", "disabled");
    //     emailjs.send('service_k792ak7', 'template_e85o09r', templateParams)
    //         .then(function(response) {
    //             alert('SUCCESS!', response.status, response.text);
    //             $('button').attr("disabled", false);
    //         }, function(error) {
    //             alert('FAILED...', error);
    //             $('button').attr("disabled", false);
    //         });
    // });
</script>
<script>
    $('#form-forgot-password').submit(function(e) {
        var email = $("#email").val();
        e.preventDefault()
        $('#form-forgot-password button[type="submit"]').attr('disabled', true).html('Submitting...');
        if ($(this).find('.alert-danger').length > 0)
            $(this).find('.alert-danger').remove();
        $.ajax({
            url: 'admin/ajax.php?action=forgot-password',
            method: 'POST',
            data: $(this).serialize(),
            error: err => {
                console.log(err)
                $('#form-forgot-password button[type="submit"]').removeAttr('disabled').html('Submit');

            },
            success: function(resp) {
                if (resp == 1) {

                    $.ajax({
                        url: "admin/action/fetch_token.php",
                        method: "POST",
                        data: {
                            email: email
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == 201) {
                                alert("Something went wrong")
                            } else {

                                $('#form-forgot-password button[type="submit"]').attr('disabled', true).html('Submitted');

                                var templateParams = {
                                    name: 'James',
                                    notes: 'Check this out!',
                                    email: email,
                                    link_password: window.location.origin + "/AcePortal/index.php?page=reset_password&token=" + data.password_token + "&email=" + email
                                };

                                emailjs.send('service_1xn6ru3', 'template_e85o09r', templateParams)
                                    .then(function(response) {
                                        console.log('SUCCESS!', response.status, response.text);
                                        $('#form-forgot-password').prepend('<div class="alert alert-success">Password reset link has been sent to ' + email + '.</div>');

                                    }, function(error) {
                                        alert('FAILED...', error);
                                        $('#form-forgot-password').prepend('<div class="alert alert-danger">There is an error sending password link to ' + email + '.</div>');
                                    });
                            }

                        }
                    })

                } else if (resp == 2) {
                    $('#form-forgot-password').prepend('<div class="alert alert-danger">Email does not exists.</div>')
                    $('#form-forgot-password button[type="submit"]').removeAttr('disabled').html('Submit');
                } else {
                    $('#form-forgot-password').prepend('<div class="alert alert-danger">Oops! Something went wrong!</div>')
                    $('#form-forgot-password button[type="submit"]').removeAttr('disabled').html('Submit');
                }
                console.log(resp);
            }
        })
    })
</script>