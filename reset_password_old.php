<?php

if (!isset($_GET['email']) || !isset($_GET['token'])) {
    header('location: /index.php?page=forgot_password');
    exit;
}

$result = $conn->query('SELECT id FROM users WHERE password_token = "'.$conn->real_escape_string(urldecode($_GET['token'])).'" AND username = "'.$conn->real_escape_string(urldecode($_GET['email'])).'" AND password_token_expiration <= "'.date('Y-m-d H:i:s', strtotime('now')).'"');


?>
<div class="container" style="margin-top: 120px">
    <div class="card w-50 mx-auto">
        <div class="card-body">
            <h4>Reset Password</h4>
            <?php if ($result->num_rows) { $user = $result->fetch_assoc(); ?>
            <form id="form-reset-password">
                <div class="form-group">
                    <input type="password" name="new_password" class="form-control" placeholder="Enter your new password">
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Retype and confirm your new password">
                </div>
                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>" />
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
            <?php } else { ?>
            <div class="alert alert-danger">
                Invalid token and email combination.
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    $('#form-reset-password').submit(function(e){
        e.preventDefault()
        $('#form-reset-password button[type="submit"]').attr('disabled',true).html('Submitting...');
        if($(this).find('.alert-danger').length > 0 )
            $(this).find('.alert-danger').remove();
        $.ajax({
            url:'admin/ajax.php?action=reset-password',
            method:'POST',
            data:$(this).serialize(),
            error:err=>{
                console.log(err)
        $('#form-reset-password button[type="submit"]').removeAttr('disabled').html('Submit');

            },
            success:function(resp){
                if(resp == 1){
                    location.href = '/index.php?page=login';
                } else if (resp == 2) {
                    $('#form-reset-password').prepend('<div class="alert alert-danger">Passwords should not be empty.</div>')
                    $('#form-reset-password button[type="submit"]').removeAttr('disabled').html('Submit');
                } else if (resp == 3) {
                    $('#form-reset-password').prepend('<div class="alert alert-danger">Please confirm your new password.</div>')
                    $('#form-reset-password button[type="submit"]').removeAttr('disabled').html('Submit');
                } else {
                    $('#form-reset-password').prepend('<div class="alert alert-danger">Oops! Something went wrong!</div>')
                    $('#form-reset-password button[type="submit"]').removeAttr('disabled').html('Submit');
                }
            }
        })
    })
</script>