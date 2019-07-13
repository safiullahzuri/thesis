<html>
<head>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/signUpIn/signupin.css')?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" ></script>

</head>
<body>
<div class="container container-fluid">
    <div class="col-md-6">
        <form method="post" enctype="multipart/form-data" id="patientForm">
            <input type="text" class="form-control" id="username" placeholder="Username">
            <input type="password" class="form-control" id="password" placeholder="Password">
            <input type="text" class="form-control" id="firstname" placeholder="First Name">
            <input type="text" class="form-control" id="lastname" placeholder="Last Name">
            <input type="file"  id="image">
            <input  type="submit" id="submitPatient" value="Register Admin"  class="form-control btn-success" />
        </form>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $("#submitPatient").click(function (e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append("username", $("#username").val());
            formData.append("password", $("#password").val());
            formData.append("firstname", $("#firstname").val());
            formData.append("lastname", $("#lastname").val());

            var inputImage = $("input#image");
            var fileToUpload = inputImage[0].files[0];

            formData.append("image", fileToUpload);

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>AdminController/createAdmin',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert(response);
                },
                error: function (a, b, c) {
                    console.log("some error");
                }



            });




        });
    });
</script>