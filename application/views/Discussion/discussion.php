<body>

<div class="container container-fluid">

    <div class="col-md-12">
        <div class="row">
            <img src="<?php echo base_url('uploads/scans/').$scan->file_name; ?>" alt="Image Not Found" width="300" height="300"  >
        </div>
        <?php if ($this->session->flashdata("comment_success")): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata("comment_success"); ?></div>
        <?php endif; ?>
        <div class="row">
            <form method="post" class="col-md-12" action="<?php echo base_url('DiscussionController/addCommentToDiscussion'); ?>">

                <input type="hidden" value="<?php echo $scan->scan_id; ?>" name="scan_id" />
                <input type="text" class="form-control" name="comment_text" required />
                <input type="submit" class="btn btn-block btn-neutral" value="Submit Your Comment" />

            </form>
        </div>

        <div class="row">
            <?php foreach ($comments as $comment): ?>
                <div id="annotationDiv" class="row">
                    <div id="doctorDiv">
                        <img id="thumbnail" style="border-radius: 50%;" src="<?php echo getAddressOfDoctor($comment->scan_id); ?>" />
                        <span><?php echo getDoctorNameFromScan($comment->scan_id); ?></span>
                    </div>

                    <div><?php echo $comment->comment_text; ?><span class="pull-right"><?php echo $comment->comment_date    ; ?></span></div>

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