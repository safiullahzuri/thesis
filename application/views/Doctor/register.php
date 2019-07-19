<body>
<div class="container container-fluid">
    <div class="col-md-6">
        <form method="post" enctype="multipart/form-data" id="patientForm">
            <input type="text" class="form-control" id="username" placeholder="Username">
            <input type="password" class="form-control" id="password" placeholder="Password">
            <input type="date" class="form-control" id="dob">
            <input type="email" class="form-control" id="email" placeholder="Email">
            <input type="text" class="form-control" id="firstname" placeholder="First Name">
            <input type="text" class="form-control" id="lastname" placeholder="Last Name">
            <input type="text" class="form-control" id="city" placeholder="City">
            <input type="text" class="form-control" id="street" placeholder="Street">
            <input type="text" class="form-control" id="postCode" placeholder="Post Code">
            <input type="text" class="form-control" id="phoneNo" placeholder="Phone No">
            <input type="file"  id="image">
            <input  type="submit" id="submitPatient" class="form-control btn-success" >Register Patient</input>
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
            formData.append("dob", $("#dob").val());
            formData.append("email", $("#email").val());
            formData.append("firstname", $("#firstname").val());
            formData.append("lastname", $("#lastname").val());
            formData.append("city", $("#city").val());
            formData.append("street", $("#street").val());
            formData.append("postCode", $("#postCode").val());
            formData.append("phoneNo", $("#phoneNo").val());

            var inputImage = $("input#image");
            var fileToUpload = inputImage[0].files[0];

            formData.append("image", fileToUpload);

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>DoctorController/createDoctor',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert(response);
                },
                error: function (a, b, c) {
                    console.log(a);
                    console.log(b);
                    console.log(c);
                }



            });




        });
    });
</script>