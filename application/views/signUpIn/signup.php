<html>
<head>
    <title>Sign In!</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/signUpIn/signupin.css')?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" ></script>

</head>
<body>



<div class="container col-md-6 col-md-offset-2">

    <div class="container">
        <div class="jumbotron">
            <h1>Welcome to PACS</h1>
            <div class="well well-sm">Please provide the required information to register your account.</div>
            <a class="btn btn-info" href="<?php echo base_url('LoginController/login'); ?>">Back to Login Page</a>
        </div>
    </div>

        <div class="well well-lg" >
            <div id="alertCard"></div>
            <form method="post" enctype="multipart/form-data" id="patientForm" action="<?php echo base_url('patientsAPI/register'); ?>">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    <input type="password" class="form-control" name="password" id="confirmPassword" placeholder="Confirm Password" required />
                    <input type="date" class="form-control" id="dob" name="dob" required>
                    <input type="email"class="form-control" name="email" placeholder="Email" required>
                    <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
                    <input type="text" class="form-control" name="job" placeholder="Job" required>
                    <input type="text" class="form-control" name="city" placeholder="City" required>
                    <input type="text" class="form-control" name="street" placeholder="Street" required>
                    <input type="text" class="form-control" name="postCode" placeholder="Post Code" required>
                    <input type="text" class="form-control" name="phoneNo" placeholder="Phone No" required>
                    <input type="file"  id="image" name="image" class="form-control">
                    <input type="hidden" name="redirect" value="yes" />
                    <input type="submit" class="btn btn-lg btn-block" id="registerPatient" value="Register Account" />
            </form>

    </div>

</div>
</body>
</html>

<script>
    $("#registerPatient").click(function (e) {
        e.preventDefault();
        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();

        if (password == confirmPassword){
            $("#patientForm").submit();
        } else{

        }


    });
</script>
