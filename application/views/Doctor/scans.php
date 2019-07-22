<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/lightGallery/dist/css/'); ?>lightgallery.min.css"/>
    <script src="<?php echo base_url('assets/lightGallery/dist/js/'); ?>lightgallery-all.min.js"></script>
    <script src="<?php echo base_url('assets/lightGallery/modules/'); ?>lg-fullscreen.min.js"></script>
    <script src="<?php echo base_url('assets/lightGallery/modules/'); ?>lg-thumbnail.min.js"></script>
</head>
<body>
<div class="container container-fluid">
    <div class="row col-md-12">
        <div class="col-md-6">
            <div id="lightgallery">
                <?php foreach ($scans as $scan): ?>
                    <a href="<?php echo base_url('uploads/scans/' . $scan->file_name); ?>">
                        <img src="<?php echo base_url('uploads/scans/' . $scan->file_name); ?>" alt="<?php echo $scan->scan_desc; ?>" width="100"
                             height="100" />
                    </a>

                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="table table-responsive" id="scansTable">
                <table>
                    <thead>
                        <th>Scan ID</th><th>Scan Thumbnail</th><th>Annotation</th><th>Discussion</th>
                    </thead>
                    <tbody>
                    <?php foreach ($scans as $scan): ?>
                    <tr>
                        <td><?php echo $scan->scan_id; ?></td>
                        <td>
                            <a href="<?php echo base_url('uploads/scans/' . $scan->file_name); ?>">
                                <img src="<?php echo base_url('uploads/scans/' . $scan->file_name); ?>" alt="<?php echo $scan->scan_desc; ?>" width="100"
                                     height="100" />
                            </a>
                        </td>
                        <td><a class="btn btn-info" href="<?php echo base_url('AnnotationController/annotation/').$scan->scan_id; ?>">Add Annotation</a></td>

                        <?php if (gotAnyCommentsBefore($scan->scan_id)): ?>
                            <td><a class="btn btn-success" href="<?php echo base_url('DiscussionController/createDiscussion/').$scan->scan_id; ?>">Contribute To Discussion</a></td>
                        <?php else: ?>
                            <td><a class="btn btn-warning" href="<?php echo base_url('DiscussionController/createDiscussion/').$scan->scan_id; ?>">Open Discussion</a></td>
                        <?php endif; ?>

                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

</div>
<script type="text/javascript">
    $("#lightgallery").lightGallery();
</script>

</body>