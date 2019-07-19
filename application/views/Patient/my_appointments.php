<body>
<div class="container container-fluid col-md-8 col-md-offset-2">
    <div>
        <table class="table table-striped table-active table-bordered" id="appointmentsTable" >
            <thead>
            <td>ID</td>
            <td>Doctor</td>
            <td>Description</td>
            <td>Date</td>
            <td>Time</td>
            <td>Action</td>
            </thead>
            <tbody>
            <?php foreach ($myAppointments as $appointment): ?>
                <tr>
                    <td><?php echo $appointment->app_id; ?></td>
                    <td><?php echo getDoctorsName($appointment->doctor_id); ?></td>
                    <td><?php echo $appointment->description; ?></td>
                    <td><?php echo $appointment->sdate; ?></td>
                    <td><?php echo $appointment->ptime; ?></td>
                    <td><button class="btn btn-warning cancel" data-id="<?php echo $appointment->app_id; ?>" <?php if($appointment->display == 'no'){echo 'disabled'; } ?> >Cancel Appointment</button></td>
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
<script type="text/javascript">
    $(document).ready(function () {

        $("#appointmentsTable").DataTable();

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
                dataType: 'json',
                url: '<?php echo base_url(); ?>AppointmentController/cancel',
                data: {id: id},
                success: function (response) {
                    if (response.cancelled == "yes"){
                        location.reload();
                    }
                    $("#deleteModal").modal("hide");
                },
                error: function (a, b, c) {
                    alert("error here");
                    console.log(a);
                    console.log(b);
                    console.log(c);
                }
            });

        });



    });





</script>
