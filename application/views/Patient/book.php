<html xmlns:https="http://www.w3.org/1999/xhtml">
<head>
    <title>Sign In!</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/signUpIn/signupin.css')?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" ></script>




    </head>

<body>
<?php $this->load->view("Patient/navigation"); ?>

<div class="container container-fluid align-center">


    <div class="col-md-9">
        <form method="post" id="doctorForm">
            <select class="form-control" id="doctor_id">
                <?php foreach ($doctors as $doctor): ?>
                    <option value="<?php echo $doctor->doctor_id?>"><?php echo $doctor->firstname.' '.$doctor->lastname?></option>
                <?php endforeach;; ?>
            </select>
            <input type="hidden" value="<?php echo $patient_id; ?>" id="patient_id" />
            <input type="date" class="form-control" id="date" />
            <input type="time" class="form-control" id="time" />
            <textarea class="form-control" id="desc"></textarea>
            <input type="submit" class="form-control btn-block" id="scheduleBtn" value="Schedule An Appointment" />
        </form>
    </div>


</div>

</body>

</html>

<script>
    $(document).ready(function () {
       $("#scheduleBtn").click(function (e) {

           e.preventDefault();
           var date = $("#date").val();
           var patient_id = $("#patient_id").val();
           var doctor_id = $("#doctor_id").val();
           var time = $("#time").val();
           var desc = $("#desc").val();


           var formData = new FormData();
           formData.append("date", date);
           formData.append("patient_id", patient_id);
           formData.append("doctor_id", doctor_id);
           formData.append("time", time);
           formData.append("desc", desc);

           $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>AppointmentController/make',
              data: formData,
               processData: false,
               contentType: false,
              success: function (response) {
                   $("#doctorForm").trigger("reset");
                   $('<div class="alert alert-info">'+response+'</div>').insertBefore("#doctor_id").delay(3000).fadeOut();

              }, error: function (a, b, c) {
                    console.log('some error in this method');
              }
           });

       });


    });
</script>