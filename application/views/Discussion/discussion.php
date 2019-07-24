<body>

<div class="container container-fluid">

    <div class="col-md-12">
        <div class="row">
            <img src="<?php echo base_url('uploads/scans/').$scan->file_name; ?>" style="border: #1d2124 3px solid" alt="Image Not Found" width="400" height="400"  >
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

        <div class="row" >
            <?php foreach ($comments as $comment): ?>
                <div id="annotationDiv" class="row">
                    <div id="doctorDiv">
                        <img id="thumbnail" src="<?php echo getAddressOfDoctor($comment->scan_id); ?>" />
                        <span class="dname"><?php echo getDoctorNameFromScan($comment->scan_id); ?></span>
                    </div>
                    <div><?php echo $comment->comment_text; ?><span class="badge badge-info date"><?php echo $comment->comment_date; ?></span></div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>



</div>
<style>
    #annotationDiv{
        width: 100%;
        border: #1d2124 3px solid;
        border-radius: 5px;
        padding: -10px;
    }

    span.dname{
        float: outside;
    }

    #doctorDiv{
        width: 200px;
        height: 100px;

    }
    #doctorDiv img{
        border-radius: 50%;
        float: left;
    }

    #thumbnail{
        width: 50px;
        height: 50px;
    }

    span.date{
        float: right;
        position: absolute;
        right: 30px;
    }

</style>



</body>