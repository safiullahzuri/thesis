<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/lightGallery/dist/css/'); ?>lightgallery.min.css" />
    <script src="<?php echo base_url('assets/lightGallery/dist/js/'); ?>lightgallery-all.min.js"></script>
    <script src="<?php echo base_url('assets/lightGallery/modules/'); ?>lg-fullscreen.min.js"></script>
    <script src="<?php echo base_url('assets/lightGallery/modules/'); ?>lg-thumbnail.min.js"></script>
</head>

<body>

<div class="container col-md-8 col-md-offset-2">
    <div id="lightgallery">
        <?php foreach ($scans as $scan): ?>
            <?php for($i=0; $i<sizeof($scan); $i++): ?>
        <a href="<?php echo base_url('uploads/scans/'.$scan[$i]["file_name"]);?>">
            <img src="<?php echo base_url('uploads/scans/'.$scan[$i]["file_name"]);?>" width="100" height="100">
        </a>
            <?php endfor; ?>
        <?php endforeach; ?>
    </div>
</div>
<script type="text/javascript">
    $("#lightgallery").lightGallery();
</script>


</body>
</html>