<body>
<div class="container container-fluid align-center">
    <div class="row">
        <div class="row">
            <?php foreach ($scans as $scan): ?>
                <?php for($i=0; $i<sizeof($scan); $i++): ?>
                <div class="col-md-4">
                    <div class="thumbnail">

                            <a href="<?php echo base_url('uploads/scans/'.$scan[$i]["file_name"]);?>">
                                <img src="<?php echo base_url('uploads/scans/'.$scan[$i]["file_name"]);?>" alt="Lights" style="width:100%">
                                <div class="caption">
                                    <p><?php echo $scan[$i]["scan_desc"]; ?></p>
                                </div>
                            </a>

                    </div>
                </div>
                <?php endfor; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
</body>