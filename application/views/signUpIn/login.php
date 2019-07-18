<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/signUpIn/signupin.css')?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" ></script>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/signin.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">

                <div class="card-body" >
                    <div id="alertCard"></div>
                    <h5 class="card-title text-center">Sign In</h5>
                    <form class="form-signin" id="form">
                        <div class="form-label-group">
                            <input type="text" id="username" class="form-control" placeholder="Username" required autofocus>
                            <label for="inputEmail">Username</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="password" class="form-control" placeholder="Password" required>
                            <label for="inputPassword">Password</label>
                        </div>

                        <div class="form-label-group" >
                            <select class="form-control" id="userType" >
                                <option value="doctor">Doctor</option>
                                <option value="patient">Patient</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <a class="btn btn-lg btn-primary btn-block text-uppercase" id="submit" >Sign In</a>
                        <a class="btn btn-lg btn-block btn-info text-uppercase" href="<?php echo base_url('logincontroller/signup'); ?>">Create a Patient Account</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


<script type="text/javascript">
    $("#submit").click(function () {
        var username = $("#username").val();
        var password = $("#password").val();
        var userType = $("#userType").val();


        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url('LoginController/loginAttempt'); ?>",
            data: {username:username, password:password, userType: userType},
            success: function (response) {
                if (response.found == "yes"){
                    var controller = userType+"Controller";
                    alert("Credentials correct");
                    window.location.replace('<?php echo base_url(); ?>'+controller);
                }else{
                  }
            },
            error:function (a,b,c) {
                $("#form")[0].reset();
                $("#alertCard").prepend('<div class="alert alert-warning">Your credentials are wrong!</div>').delay(2000).fadeOut();

                $("#username").focus();
                console.log(a);console.log(b);console.log(c);
            }
        });
    });
</script>