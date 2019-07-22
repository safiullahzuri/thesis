<body>

<div class="container container-fluid">

    <div class="col-md-12">
        <div class="row">
            <img src="<?php echo base_url('uploads/scans/').$scan->file_name; ?>" alt="Image Not Found" width="300" height="300"  >
        </div>
        <?php if ($this->session->flashdata("ann_success")): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata("ann_success"); ?></div>
        <?php endif; ?>
        <div class="row">
            <form method="post" class="col-md-12" action="<?php echo base_url('AnnotationController/addAnnotation'); ?>">

                <input type="hidden" value="<?php echo $scan->scan_id; ?>" name="scan_id" />
                <input type="text" class="form-control" name="annotation_text" required />
                <input type="submit" class="btn btn-block btn-neutral" value="Submit Annotation" />

            </form>
        </div>

        <div class="row">
            <?php foreach ($annotations as $annotation): ?>
            <div id="annotationDiv" class="row">
                <div id="doctorDiv">
                    <img id="thumbnail" style="border-radius: 50%;" src="<?php echo getAddressOfDoctor($annotation->scan_id); ?>" />
                    <span><?php echo getDoctorNameFromScan($annotation->scan_id); ?></span>
                </div>

                  <div><?php echo $annotation->annotation_text; ?><span class="pull-right"><?php echo $annotation->ann_date; ?></span></div>

            </div>
            <?php endforeach; ?>
        </div>

    </div>



</div>
<style>
    #annotationDiv{
        width: 100%;
        border: red 3px;
        border-radius: 5px;

    }

    #doctorDiv{
        width: 100px;
        height: 100px;
    }

    #thumbnail{
        width: 50px;
        height: 50px;
    }

</style>



</body>