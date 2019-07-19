<body>
<div class="container container-fluid align-center">
    <div class="row">


            <div class="row">
                <?php foreach ($scans as $scan): ?>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="<?php echo base_url('uploads/scans/'.$scan->file_name);?>">
                                <img src="<?php echo base_url('uploads/scans/'.$scan->file_name);?>" alt="Lights" style="width:100%">
                                <div class="caption">
                                    <p><?php echo $scan->scan_desc; ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>




    </div>
</div>


</body>