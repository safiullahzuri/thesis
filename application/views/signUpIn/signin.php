<html>
<head>
    <title>Sign In!</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/signUpIn/signupin.css')?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" ></script>

</head>
<body>



<div class="container container-fluid">
    <div class="row">
        <div class="col-md-9" >
            <form method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="username" />
                </div>
                <input type="password" class="form-control" id="password" />
                <select class="form-control" id="userType">
                    <option value="doctor">Doctor</option>
                    <option value="patient">Patient</option>
                    <option value="admin">Admin</option>
                </select>
                <a class="btn btn-block btn-success" id="submit" >Sign In</a>
            </form>
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
            url: "<?php echo base_url('LoginController/salam'); ?>",
            data: {username:username, password:password, userType: userType},
            success: function (response) {
                var result = jQuery.parseJSON(response);
                if (result.found == "yes"){
                    var controller = userType+"Controller";
                    alert("Credentials correct");
                    window.location.replace('<?php echo base_url(); ?>'+controller);
                }else{
                    alert("Credentials not correct");
                }
            },
            error:function (a,b,c) {
                console.log(a);console.log(b);console.log(c);
            }
        });
    });
</script>