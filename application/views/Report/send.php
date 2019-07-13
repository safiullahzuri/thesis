<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/editor/editor.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="<?php echo base_url(); ?>assets/editor/editor.css" type="text/css" rel="stylesheet"/>
    <script src="<?php echo base_url(); ?>assets/printthis/printThis.js"></script>
</head>
<body style="margin: 40px; ">

<div class="container container-fluid align-center">
    <div class="row">

        <div id="printContainer">
        <div class="col-md-9">
            <div class="row">
                <div class="jumbotron" style="font-size: large">
                    <?php echo $diagnosis_content; ?>
                </div>
            </div>


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

        <div class="col-md-3">
            <form method="post" action="<?php echo base_url(); ?>ReportController/sendZipFileMassEmail">
                <button type="button" id="addBtn" class="btn btn-primary">Add Recipient</button>
                <input type="hidden" name="appointment_id" value="<?php echo $appointment_id; ?>" />
                <div id="recipients">

                </div>
                <input type="submit" class="btn btn-success" id="sendBtn" value="Send Report" style="display: none;" />
            </form>
        </div>
        <div class="col-md-2">
            <button class="btn btn-light" id="print">Print This Diagnosis</button>
        </div>


    </div>
</div>


</body>
</html>
<script>
    $(document).ready(function () {
        var counter = 0;
        $("#addBtn").click(function () {
            $("#recipients").append('<input id="'+counter+'" name="recipients[]" type="email" class="recipientEmail form-control" /><a class="btn btn-danger removeRecipient" id="'+counter+'">Delete</a>');
            $("#sendBtn").css("display", "block");
            counter++;
        });


        $(document).on('click', '.removeRecipient', function () {
            var id = $(this).attr("id");
            console.log(id);

            $("input#"+id).remove();
            $(this).remove();

            if ($("#recipients").children().size() == 0){
                $("#sendBtn").css("display", "none");
            }

        });

        $("#print").click(function () {
            $("#printContainer").printThis({
                debug: false,               // show the iframe for debugging
                importCSS: true,            // import parent page css
                importStyle: false,         // import style tags
                printContainer: true,       // print outer container/$.selector
                loadCSS: "",                // path to additional css file - use an array [] for multiple
                pageTitle: "",              // add title to print page
                removeInline: false,        // remove inline styles from print elements
                removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
                printDelay: 333,            // variable print delay
                header: null,               // prefix to html
                footer: null,               // postfix to html
                base: false,                // preserve the BASE tag or accept a string for the URL
                formValues: true,           // preserve input/form values
                canvas: false,              // copy canvas content
                doctypeString: '...',       // enter a different doctype for older markup
                removeScripts: false,       // remove script tags from print content
                copyTagClasses: false,      // copy classes from the html & body tag
                beforePrintEvent: null,     // function for printEvent in iframe
                beforePrint: null,          // function called before iframe is filled
                afterPrint: null
            });
        });




    });
</script>
