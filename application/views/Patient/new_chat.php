<style>

    .myList{
        list-style: none;
        width: 200px;
    }
    .myList li{
        padding: 10px 10px;
    }
    .myList li:hover{
        background: red;
    }
    div#doctors{
        width: 200px;
        float: left;
    }


    div#messages{
        border: 5px solid #9fcdff;
        border-radius: 5px;
        width: 700px;
        height: auto;
        float: left;
        position: relative;
    }

    #messageBar{
        scroll-y:auto;
    }

    div#clear{
        clear: both;
    }

    #sendMessageDiv{
        width: 100%;
    }



</style>
<head>
    <title>Chat With Patients</title>
</head>
<body>

<div class="row col-md-12">
    <div id="doctors" class="col-md-4">
        <ul class="myList">
            <?php foreach ($doctors as $doctor): ?>
                <li class="doctor" data-id="<?php echo $doctor->doctor_id; ?>"><?php echo getDoctorsName($doctor->doctor_id); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id="messages" class="col-md-4">
        <div id="messageBar">

        </div>

    </div>
    <div id="sendMessageDiv" style="display: none; float: left" class="col-md-4">
        <input type="hidden" id="fromType" value="patient" />
        <input type="hidden" id="fromId" value="<?php echo $patientId; ?>" />
        <input type="hidden" name="toId" id="toId" value="" />
        <input type="text" class="form-control" id="message" />
        <button class="form-control" id="sendMessageBtn">Send Message</button>
    </div>
    <div id="clear">

    </div>


</div>


</body>
<script>

    $("li.doctor").click(function () {
        var patientId = $(this).attr("data-id");
        $("li.doctor").css("background", "white");
        $(this).css("background", "blue");
        $("#toId").val(patientId);
        $("#sendMessageDiv").css("display", "block");
        refreshMessageDiv();
    });

    function refreshMessageDiv() {
        $("#messageBar").empty();
        var fromId = $("input#fromId").val();
        var toId = $("input#toId").val();
        var fromType = $("input#fromType").val();

        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '<?php echo base_url('ChatController/getMessages'); ?>',
            data: {fromId: fromId, toId:toId, fromType: fromType},
            success: function (response) {
                for(var i=0; i<response.length; i++){
                    if (response[i].from_type == 'doctor'){
                        $("#messageBar").append('<div style="width: 100%;  position: relative; margin-bottom: 5px; padding: 10px; background-color:#f7e1b5 ">'+response[i].message+'<span class="badge badge-info mTime" style="position: absolute; right: 30px;">'+response[i].m_time+'</span></div>');
                    }else if (response[i].from_type == 'patient'){
                        $("#messageBar").append('<div style="width: 100%; position: relative; margin-bottom: 5px; padding: 10px; background-color:#9fcdff ">'+response[i].message+'<span class="badge badge-info mTime" style="position: absolute; right: 30px;">'+response[i].m_time+'</span></div>');
                    }
                }

                if (response.length == 0){
                    $("#messageBar").append('<div class="alert alert-warning">No Previous Conversation</div>');
                }
            },
            error: function (a, b, c) {
                alert("something wrong");
            }
        });
    }

    $("#sendMessageBtn").click(function (event) {
        sendMessage();
    });

    $(document).on('keypress', function (e) {
        if (e.which == 13){
            sendMessage();
        }
    });

    function sendMessage() {
        var fromId = $("input#fromId").val();
        var toId = $("input#toId").val();
        var fromType = $("input#fromType").val();
        var message = $("input#message").val();

        if (message != ''){
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('ChatController/addMessage');  ?>',
                data: {fromId: fromId, toId:toId, fromType:fromType, message:message},
                success: function (response) {
                    if (response == "success"){
                        $("input#message").val('');
                        refreshMessageDiv();
                    }
                },
                error: function (a, b, c) {
                    console.log(a); console.log(b); console.log(c);
                }
            });
        }else{
            alert("Message can not be empty.");
        }
    }


</script>