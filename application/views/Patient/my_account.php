<html>
<head>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/signUpIn/signupin.css')?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" ></script>

</head>
<body>
<?php $this->load->view("patient/navigation"); ?>

<div class="container container-fluid col-md-8 col-md-offset-2">
    <?php if($this->session->flashdata("changePasswordMessage")): ?>
        <div class="alert alert-info" id="mAlert"><?php echo $this->session->flashdata("changePasswordMessage"); ?></div>
    <?php endif; ?>
    <div>
        <table class="table table-striped table-active table-bordered">
            <thead>
            <td>thumbnail</td>
            <td>ID</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Email</td>
            <td>City</td>
            <td colspan="3">Action</td>
            </thead>
            <tbody id="patientsTb">

            <tr>
                <td><img width="100" src="<?php echo base_url('uploads/avatars/').$patient->image; ?>" </td>
                <td><?php echo $patient->patient_id; ?></td>
                <td><?php echo $patient->firstname; ?></td>
                <td><?php echo $patient->lastname; ?></td>
                <td><?php echo $patient->email; ?></td>
                <td><?php echo $patient->city; ?></td>
                <td><button class="btn btn-warning edit" data-id="<?php echo $patient->patient_id; ?>">Edit</button></td>
                <td><button class="btn btn-dark changePassword" data-id="<?php echo $patient->patient_id; ?>">Change Password</button></td>
            </tr>

            </tbody>
        </table>
    </div>
</div>
<!-- Edit Dialog Here -->
<!-- Modal -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="patientForm">
                    <input type="hidden" id="patient_id" />
                    <input type="text" class="form-control" id="username" placeholder="Username">
                    <input type="date" class="form-control" id="dob">
                    <input type="email" class="form-control" id="email" placeholder="Email">
                    <input type="text" class="form-control" id="firstname" placeholder="First Name">
                    <input type="text" class="form-control" id="lastname" placeholder="Last Name">
                    <input type="text" class="form-control" id="job" placeholder="Job">
                    <input type="text" class="form-control" id="city" placeholder="City">
                    <input type="text" class="form-control" id="street" placeholder="Street">
                    <input type="text" class="form-control" id="postCode" placeholder="Post Code">
                    <input type="text" class="form-control" id="phoneNo" placeholder="Phone No">
                    <div>
                        <img id="image" width="200" height="200" />
                    </div>
                    <input type="file"  id="image">

                </form>
            </div>
            <div class="modal-footer">
                <input  type="submit" id="editPatient" class="form-control btn-success" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- End Edit Dialog -->

<!-- Change Password Dialog Here -->
<!-- Modal -->

<div id="changeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url('PatientController/changePassword'); ?>" id="changeForm">
                    <div id="changeAlert"></div>
                    <div class="form-group">
                        <label>Previous Password</label>
                        <input type="hidden" value="patientId" id="changePatientId" name="patientId"/>
                        <input type="password" class="form-control" name="previousPassword" />
                    </div>
                    <div class="form-group">
                        <label>Previous Password</label>
                        <input type="password" class="form-control" name="newPassword" id="newPassword" />
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" />
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <input  type="submit" value="Change Password" id="changePasswordBtn" class="form-control btn-success" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- End Change Dialog -->




</body>
</html>
<script type="text/javascript">

    $(document).ready(function () {

        setTimeout(function (event) {
            $("#mAlert").hide();
        }, 3000);


        $(".changePassword").click(function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            $("#changeModal").modal("show");
            $("#changePatientId").val(id);
        });

        $("#changePasswordBtn").click(function (event) {

            var password = $("#newPassword").val();
            var confirmPassword = $("#confirmPassword").val();

            if (password != confirmPassword){
                $("#changeAlert").append('<div class="alert alert-warning">Password and Confirm Password fields do not match!</div>').delay(3000).fadeOut();
            }else{
                $("form#changeForm").submit();
            }

        });


        $(".edit").click(function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            showEditDialog(id);
        });




        //edit dialog
        function showEditDialog(id) {
            $("#editModal").modal("show");
            $("#patient_id").val(id);
            $.ajax({
                type: 'POST',
                data: {id: id},
                url: '<?php echo base_url(); ?>PatientController/patient',
                async: false,
                dataType: 'json',
                success: function (response) {
                    $("#firstname").val(response.firstname);
                    $("#lastname").val(response.lastname);
                    $("#dob").val(response.dob);
                    $("#job").val(response.job);
                    $("#city").val(response.city);
                    $("#street").val(response.street);
                    $("#username").val(response.username);
                    $("#postCode").val(response.postCode);
                    $("#phoneNo").val(response.phoneNo);
                    $("#email").val(response.email);
                    $("#image").attr('src', '<?php echo base_url(); ?>Uploads/avatars/'+response.image);
                },
                error: function (a, b, c) {
                    console.log(a);
                    console.log(b);
                    console.log(c);
                }
            });
        }

        //finalize editing a patient data
        $("#editPatient").click(function (e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append("patient_id", $("#patient_id").val());
            formData.append("username", $("#username").val());
            formData.append("dob", $("#dob").val());
            formData.append("email", $("#email").val());
            formData.append("firstname", $("#firstname").val());
            formData.append("lastname", $("#lastname").val());
            formData.append("city", $("#city").val());
            formData.append("street", $("#street").val());
            formData.append("job", $("#job").val());
            formData.append("postCode", $("#postCode").val());
            formData.append("phoneNo", $("#phoneNo").val());

            var inputImage = $("input#image");
            var newImage = "false";
            if (inputImage.val() != 0){
                var fileToUpload = inputImage[0].files[0];
                formData.append("image", fileToUpload);
                newImage = "true";
            }

            formData.append("newImage", newImage);


            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>PatientController/edit',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert(response);
                    window.location.replace('<?php echo base_url(); ?>PatientController/myAccount');
                },
                error: function (a, b, c) {
                    console.log("some error");
                }
            });

        });





    });



</script>
