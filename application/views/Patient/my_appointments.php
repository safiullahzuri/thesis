<html>
<head>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/signUpIn/signupin.css')?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" ></script>
    <title>My Appointments</title>
</head>
<body>
<?php $this->load->view("patient/navigation"); ?>
<div class="container container-fluid">
    <div class="col-md-10">
        <table class="table table-striped table-active table-bordered">
            <thead>
            <td>Doctor</td>
            <td>Description</td>
            <td>Date</td>
            <td>Time</td>
            <td colspan="2">Action</td>
            </thead>
            <tbody id="doctorsTb">
            <?php foreach ($myAppointments as $appointment): ?>
                <tr>
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
<script>
    $(document).ready(function () {
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
