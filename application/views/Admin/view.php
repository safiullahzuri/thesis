<html>
<head>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/signUpIn/signupin.css')?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" ></script>
    <title>View</title>
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
            <tbody id="doctorsTb">

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
                <form method="post" enctype="multipart/form-data" id="adminForm">
                    <input type="hidden" id="admin_id" />
                    <input type="text" class="form-control" id="username" placeholder="Username">
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
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this admin record?</p>
                <input type="hidden" id="del_admin_id" />
            </div>
            <div class="modal-footer">
                <input  type="submit" value="Delete" id="deleteAdmin" class="form-control btn-danger" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- end delete modal -->




</body>
</html>
<script type="text/javascript">

    $(document).ready(function () {
        initializeAdminData();



        //

        $(".edit").click(function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            showEditDialog(id);
        });


        $(".delete").click(function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            showDeleteDialog(id);
        });

        //show delete dialog
        function showDeleteDialog(id) {
            $("#deleteModal").modal("show");
            $("#del_admin_id").val(id);

        }

        $("#deleteAdmin").click(function (e) {
            e.preventDefault();
            var id = $("#del_admin_id").val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>AdminController/delete',
                data: {id: id},
                success: function (response) {
                    $("#deleteModal").modal("hide");
                    alert(response);
                    window.location.replace('<?php echo base_url(); ?>AdminController/view');
                },
                error: function (a, b, c) {
                    console.log(a);
                    console.log(b);
                    console.log(c);
                    $("#deleteModal").modal("hide");
                    alert("Could not delete");
                }
            });

        });

        //edit dialog
        function showEditDialog(id) {
            $("#editModal").modal("show");
            $("#admin_id").val(id);
            $.ajax({
                type: 'POST',
                data: {id: id},
                url: '<?php echo base_url(); ?>AdminController/admin',
                async: false,
                dataType: 'json',
                success: function (response) {
                    $("#firstname").val(response.firstname);
                    $("#lastname").val(response.lastname);
                    $("#username").val(response.username);
                    $("#image").attr('src', '<?php echo base_url(); ?>Uploads/'+response.image);
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
                url: '<?php echo base_url(); ?>AdminController/edit',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert(response);
                    window.location.replace('<?php echo base_url(); ?>AdminController/view');
                },
                error: function (a, b, c) {
                    console.log(a);
                    console.log(b);
                    console.log(c);
                    console.log("some error");
                }
            });

        });



        //get all patients
        function initializeAdminData() {
            $.ajax({
                type: 'ajax',
                async: false,
                dataType: 'json',
                url: '<?php echo base_url(); ?>AdminController/admins',
                success: function (response) {
                    console.log(response);
                    var html = '';

                    for (var i=0; i<response.length; i++){
                        html += '<tr>'+
                            '<td> <img class="img-thumbnail" src="<?php echo base_url(); ?>uploads/'+response[i].image+'">'+'</td>'
                            +'<td>'+response[i].admin_id+'</td>'
                            +'<td>'+response[i].firstname+'</td>'
                            +'<td>'+response[i].username+'</td>'
                            +'<td>'+response[i].lastname+'</td>'
                            +'<td>'+
                            '<button class="btn btn-warning edit" data-id="'+response[i].admin_id+'">Edit</button></td><td>'+
                            '<button class="btn btn-danger delete" data-id="'+response[i].admin_id+'">Delete</button></td>';
                    }

                    $("#doctorsTb").html(html);
                },
                error: function (a,b,c) {
                    console.log(a); console.log(b); console.log(c);
                    console.log('wrong');
                }
            })
        };

    });



</script>
