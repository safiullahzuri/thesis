<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/lightGallery/dist/css/'); ?>lightgallery.min.css"/>
    <script src="<?php echo base_url('assets/lightGallery/dist/js/'); ?>lightgallery-all.min.js"></script>
    <script src="<?php echo base_url('assets/lightGallery/modules/'); ?>lg-fullscreen.min.js"></script>
    <script src="<?php echo base_url('assets/lightGallery/modules/'); ?>lg-thumbnail.min.js"></script>
</head>
<body>
<div class="container container-fluid col-md-8 col-md-offset-2">
     <div id="lightgallery">
        <?php foreach ($scans as $scan): ?>
            <a href="<?php echo base_url('uploads/scans/' . $scan->file_name); ?>">
                <img src="<?php echo base_url('uploads/scans/' . $scan->file_name); ?>" alt="<?php echo $scan->scan_desc; ?>" width="100"
                     height="100" />

            </a>
        <?php endforeach; ?>
    </div>
</div>

</div>
<script type="text/javascript">
    $("#lightgallery").lightGallery();
</script>

</body>