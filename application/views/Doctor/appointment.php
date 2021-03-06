<head>
<title>My Appointments</title>
</head>
<body>

<div class="container container-fluid col-md-8 col-md-offset-2">
    <div>
        <table class="table table-striped table-active table-bordered" id="table">
            <thead>
            <td>Patient</td>
            <td>Description</td>
            <td>Date</td>
            <td>Time</td>
            <td>View/Upload</td>
            <td>Cancel Appointment</td>
            </thead>
            <tbody id="doctorsTb">
            <?php foreach ($myAppointments as $appointment): ?>
                <tr>
                    <td><?php echo getPatientsName($appointment->patient_id); ?></td>
                    <td><?php echo $appointment->description; ?></td>
                    <td><?php echo $appointment->sdate; ?></td>
                    <td><?php echo $appointment->ptime; ?></td>
                    <?php if($appointment->display == "yes"): ?>
                        <td><a class="btn btn-info" href="<?php echo base_url(); ?>AppointmentController/appointment/<?php echo $doctor_id; ?>/<?php echo $appointment->app_id; ?>">Upload Scans</a></td>
                    <?php elseif ($appointment->display == "no"): ?>
                        <td><a class="btn btn-primary" href="<?php echo base_url(); ?>DoctorController/getScans/<?php echo $appointment->app_id; ?>" >View Scans</a></td>
                    <?php endif; ?>

                    <td><button class="btn btn-warning cancel" data-id="<?php echo $appointment->app_id; ?>" <?php if($appointment->display == "no"){echo "disabled"; }?> >Cancel Appointment</button></td>
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
