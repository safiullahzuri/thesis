<body>
<div class="container container-fluid col-md-8 col-md-offset-2">
    <div>
        <table class="table table-striped table-active table-bordered" id="table">
            <thead>
              <td>ID</td>
              <td>Diagnosis For (patient)</td>
              <td>Diagnosis File</td>
              <td>Scans</td>
            </thead>
            <tbody>
            <?php foreach ($myDiagnosis as $diagnosis): ?>
                <tr>
                    <td><?php echo $diagnosis["diagnosis_id"]; ?></td>
                    <td><?php echo getPatientsNameFromAppointment($diagnosis["appointment_id"]); ?></td>
                    <td><a class="btn btn-success" href="<?php echo base_url('ReportController/generateReport/').$diagnosis["appointment_id"]; ?>">Download Diagnosis</a></td>
                    <td><a class="btn btn-primary" href="<?php echo base_url('DoctorController/getScans/').$diagnosis["appointment_id"]; ?>">See Scans</a></td>
                </tr>
            <?php endforeach; ?>
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
                    <input type="password" class="form-control" id="password" placeholder="Password">
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

<!-- Delete Dialog Here -->
<!-- Modal -->




</body>
</html>
<script type="text/javascript">

    $(document).ready(function () {

        $("#table").DataTable();

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
                    $("#password").val(response.password);
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
            formData.append("password", $("#password").val());
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
