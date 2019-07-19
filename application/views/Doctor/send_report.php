<body>

<div class="container container-fluid col-md-8 col-md-offset-2">
    <div>
        <table class="table table-striped table-active table-bordered" id="table">
            <thead>
            <td>ID</td>
            <td>Diagnosis For (patient)</td>
            <td>Email Diagnosis Report</td>
            <td>Export PDF</td>
            </thead>
            <tbody>
            <?php foreach ($myDiagnosis as $diagnosis): ?>
                <tr>
                    <td><?php echo $diagnosis["diagnosis_id"]; ?></td>
                    <td><?php echo getPatientsNameFromAppointment($diagnosis["appointment_id"]); ?></td>
                    <td><a class="btn btn-success email" id="<?php echo $diagnosis["appointment_id"]; ?>">Send Via Email ==></a></td>
                    <td><a class="btn btn-primary" href="<?php echo base_url('ReportController/generateReport/').$diagnosis["appointment_id"]; ?>">Export PDF</a></td>
                 </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Edit Dialog Here -->
<!-- Modal -->
<div id="sendMailModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('ReportController/sendZipFileMassEmail'); ?>">
            <div class="modal-body">

                    <button id="addRecipient" class="btn btn-warning align-center" >Add Recipient</button>
                    <input type="hidden" name="appointment_id" id="last_appointment" />
                    <div id="recipients">

                    </div>


            </div>
            <div class="modal-footer">
                <input  type="submit" id="sendReport" class="form-control btn-success" value="Send Report" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>

    </div>
</div>


</body>
</html>
<script type="text/javascript">

    $(document).ready(function () {

        $("#table").DataTable();

        $("#sendReport").css('display', 'none');
        var counter = 0;

        $(".email").click(function () {
            $("#sendMailModal").modal("show");
            $("#last_appointment").val($(this).attr("id"));
        });

        $("#addRecipient").click(function (event) {
            event.preventDefault();
            $("#sendReport").css('display', 'block');
            $("#recipients").append('<input type="text" class="form-control" id="'+counter+'" name="recipients[]" />');
            $("#recipients").append('<a class="btn btn-danger deleteRecipient" id="'+counter+'">Delete</a>');
            counter++;
        });

        $(document).on('click', '.deleteRecipient', function () {

            var id = $(this).attr("id");
            $("input#"+id).remove();
            $(this).remove();

        });


    });



</script>
