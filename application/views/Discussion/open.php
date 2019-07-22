<body>

<div class="container container-fluid col-md-8 col-md-offset-2">
    <div>
        <table class="table table-striped table-active table-bordered" id="table">
            <thead>
            <td>ID</td>
            <td>Thumbnail</td>
            <td>Discussion By</td>
            <td>Contribute</td>
            </thead>
            <tbody id="doctorsTb">
            <?php foreach ($discussions as $discussion): ?>
                <tr>
                   <td> <?php echo $discussion->scan_id; ?></td>
                    <td><img src="<?php echo getScanImage($discussion->scan_id); ?>" alt="Image Not Found" width="75" height="75"></td>
                    <td><?php echo getDoctorNameFromScan($discussion->scan_id); ?></td>
                    <td><a class="btn btn-info" href="<?php echo base_url('DiscussionController/createDiscussion/').$discussion->scan_id; ?>">Contribute To Discussion</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


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
                <p>Are you sure you want to cancel this appointment?</p>
                <input type="hidden" id="cancel_app_id" />
            </div>
            <div class="modal-footer">
                <button id="cancelAppointment" class="btn btn-danger">Cancel</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- end delete modal -->
</body>
</html>
<script>
    $(document).ready(function () {

        $("#table").DataTable();

        $(".cancel").click(function (e) {
            e.preventDefault();
            var appointment_id = $(this).attr("data-id");
            $("#cancel_app_id").val(appointment_id);

            $("#deleteModal").modal("show");

        });

        $("#cancelAppointment").click(function (e) {
            e.preventDefault();
            var id = $("#cancel_app_id").val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>AppointmentController/cancel',
                data: {id: id},
                success: function (response) {
                    if (response.cancelled == "yes"){
                        location.reload();
                    }
                    $("#deleteModal").modal("hide");
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
