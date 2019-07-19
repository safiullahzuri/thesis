
<body>

<div class="container container-fluid col-md-8 col-md-offset-2">

    <div">
        <table class="table table-striped table-active table-bordered" id="myTable">
            <input type="button" class="btn btn-success" value="Register Patient" id="registerPatient" style="margin-bottom: 20px;" />
            <thead>
                <td>thumbnail</td>
                <td>ID</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Email</td>
                <td>City</td>
            </thead>
            <tbody id="patientsTb">

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



</body>
</html>
<script type="text/javascript">

    $(document).ready(function () {
        initializePatientData();

        $("#myTable").DataTable();

        //

        $("#registerPatient").click(function (e) {
            e.preventDefault();
            $("#editModal").modal("show");
        });





        //finalize editing a patient data
        $("#editPatient").click(function (e) {
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
                url: '<?php echo base_url(); ?>PatientsAPI/register',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert(response);
                    window.location.replace('<?php echo base_url(); ?>AdminController/managePatients');
                },
                error: function (a, b, c) {
                    console.log("some error");
                }
            });

        });



        //get all patients
        function initializePatientData() {
          $.ajax({
              type: 'ajax',
              async: false,
              dataType: 'json',
              url: '<?php echo base_url(); ?>PatientsAPI/patients',
              success: function (response) {
                  console.log(response);
                  var html = '';

                  for (var i=0; i<response.length; i++){
                      html += '<tr>'+
                                    '<td> <img width="100" height="100" class="img-thumbnail" src="<?php echo base_url(); ?>uploads/avatars/'+response[i].image+'">'+'</td>'
                                    +'<td>'+response[i].patient_id+'</td>'
                                    +'<td>'+response[i].firstname+'</td>'
                                    +'<td>'+response[i].lastname+'</td>'
                                    +'<td>'+response[i].email+'</td>'
                                    +'<td>'+response[i].city+'</td>';
                  }

                  $("#patientsTb").html(html);
              },
              error: function (a,b,c) {
                  console.log(a); console.log(b); console.log(c);
                  console.log('wrong');
              }
          })
        };

    });



</script>
