<html>
<head>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/signUpIn/signupin.css')?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" ></script>

</head>
<body>

<div class="container container-fluid">
    <div class="col-md-10">
        <table class="table table-striped table-active table-bordered">
            <thead>
            <td>thumbnail</td>
            <td>ID</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Username</td>
            <td colspan="3">Action</td>
            </thead>
            <tbody id="patientsTb">

            <tr>
                <td><img width="100" src="<?php echo base_url('uploads/avatars/').$admin->image; ?>" </td>
                <td><?php echo $admin->admin_id; ?></td>
                <td><?php echo $admin->firstname; ?></td>
                <td><?php echo $admin->lastname; ?></td>
                <td><?php echo $admin->username; ?></td>
                <td><button class="btn btn-warning edit" data-id="<?php echo $admin->admin_id; ?>">Edit</button></td>
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
                <form method="post" enctype="multipart/form-data"  >
                    <input type="hidden" id="admin_id" />
                    <input type="text" class="form-control" id="username" placeholder="Username">
                    <input type="password" class="form-control" id="password" placeholder="Password">
                    <input type="text" class="form-control" id="firstname" placeholder="First Name">
                    <input type="text" class="form-control" id="lastname" placeholder="Last Name">
                    <div>
                        <img id="image" width="200" height="200" />
                    </div>
                    <input type="file"  id="image">

                </form>
            </div>
            <div class="modal-footer">
                <input  type="submit" id="editAdmin" class="form-control btn-success" />
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

        $(".edit").click(function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            showEditDialog(id);
        });

        //edit dialog
        function showEditDialog(id) {
            $("#editModal").modal("show");
            $("#admin_id").val(id);
            $.ajax({
                type: 'POST',
                data: {id: id},
                url: '<?php echo base_url(); ?>AdminAPI/admin',
                async: false,
                dataType: 'json',
                success: function (response) {

                    $("#firstname").val(response.firstname);
                    $("#lastname").val(response.lastname);
                    $("#username").val(response.username);
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
        $("#editAdmin").click(function (e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append("admin_id", $("#admin_id").val());
            formData.append("username", $("#username").val());
            formData.append("password", $("#password").val());
            formData.append("firstname", $("#firstname").val());
            formData.append("lastname", $("#lastname").val());

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
                url: '<?php echo base_url(); ?>AdminAPI/edit',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert(response);
                    window.location.replace('<?php echo base_url(); ?>AdminController/myAccount');
                },
                error: function (a, b, c) {
                    console.log("some error");
                }
            });

        });





    });



</script>
