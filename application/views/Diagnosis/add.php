<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/editor/editor.js"></script>
    <script>
        $(document).ready(function() {
            $("#txtEditor").Editor();
        });
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="<?php echo base_url(); ?>assets/editor/editor.css" type="text/css" rel="stylesheet"/>

</head>
<body style="margin-top: 30px;">
<div class="container container-fluid align-center">
    <div class="row">
        <div class="col-md-12">
            <select class="form-control" id="template">
                <option>No Template</option>
                <option value="bone">Bone Scan</option>
                <option value="liver">Liver Scan</option>
                <option value="heart">Heart Scan</option>
            </select>
            <input type="hidden" id="appointment_id" value="<?php echo $appointment_id ;?>" />
            <textarea id="diagnosis" class="form-control"></textarea>
        </div>
        <button id="text" class="btn btn-primary btn-block align-center">Save Diagnosis</button>
    </div>
</div>


</body>
</html>
<script type="text/javascript">





    $(document).ready(function (event) {
       $("#diagnosis").Editor();

       $("#template").change(function () {
           var template = $(this).val();
           if (template == "bone"){
               var text = "<b>The diagnosis for the bone scans that have been uploaded will be as such: </b><hr><br> ";
           }else if (template == "liver"){
               var text = "<b>The diagnosis for the liver scans that have been uploaded will be as such: </b><hr><br>";
           }else if (template == "heart"){
               var text = "<b>The diagnosis for the heart scans that have been uploaded will be as such: </b><hr><br>";
           }else{
               var text = "";
           }
           $("#diagnosis").Editor("setText", text);
       });
    });

    $("#text").click(function () {
        var myText = $("#diagnosis").Editor("getText");
        var appointment_id = $("#appointment_id").val();

        console.log(myText); console.log(appointment_id);

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>DiagnosisController/saveDiagnosis',
            data: {appointment_id: appointment_id, diagnosis_text: myText},
            dataType: 'json',
            success: function (response) {
                if (response.wrote == "yes"){
                    //TODO: do something here
                    window.location.replace('<?php echo base_url().'ReportController/sendReport/'.$appointment_id; ?>')

                }
                console.log(response.wrote);
            },
            error: function (a, b, c) {
                console.log(a);
                console.log(b);
                console.log(c);
            }
        })


    });


</script>

