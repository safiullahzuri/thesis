<html>
<head>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/signUpIn/signupin.css')?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" ></script>

</head>
<body>

<div class="row" style="margin: 0px; padding: 20px 0px; font-size: 18px; background-color: #e3e3e3; text-align: center" >
    <div class="col-md-10">
        <h1>Please Upload the Patient's Scans</h1>
    </div>
</div>

<?php if($this->session->flashdata("upload_success")): ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata("upload_success"); ?></div>
<?php endif; ?>
<?php echo form_open_multipart("UploadScanController/uploadScans"); ?>
<input type="hidden" name="appointment_id" value="<?php echo $appointment_id; ?>">
<div class="row" style="margin: 0px; padding: 20px; text-align: center; ">
    <div class="col-md-10">
        <button id="addScan" class="btn btn-danger">Add Scan</button>
    </div>
</div>

<div class="row" style="margin: 0px; padding: 20px; text-align: center; ">
    <div class="col-md-10">
        <div id="uploadScanContainer"></div>
        <div id="submit" style="display: none;">
            <input type="submit" value="Go To Diagnosis" name="submit" class="btn btn-primary" />
        </div>
    </div>
</div>
<?php echo form_close(); ?>

</body>
</html>

<script>
$(document).ready(function () {

    var textAreaNumber = 0;

    $(document).on('click', 'button#addScan', function (event) {
        event.preventDefault();
        $("div#submit").css('display', 'block');
        addScanInput();
    });
    
    
    function addScanInput() {
        var html = '';
        html += '<div class="alert alert-info">';
        html += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>';
        html += '<strong>Upload Scan</strong>';
        html += '<input type="file" class="form-control" accept="image/*" name="multipleFiles[]" />';
        html += '<textarea class="form-control" name="description[]"></textarea>'
        html += '</div>';
        textAreaNumber++;

        $("div#uploadScanContainer").append(html);
    }
    
    
    
    
})
    
</script>