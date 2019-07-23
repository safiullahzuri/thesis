<?php


class ChatController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function addMessage(){
        $fromType = $this->input->post("fromType");
        $fromId=  $this->input->post("fromId");
        $toId = $this->input->post("toId");
        $message = $this->input->post("message");

        $chatData = array("from_type" => $fromType, "from_id" => $fromId, "to_id" => $toId, "message" => $message);


        if ($this->ChatModel->addMessage($chatData)){
            //todo:
            echo "success";
        }else{
            //todo:
            echo "failure";
        }
    }

    function getMessages(){
        $fromId = $this->input->post("fromId");
        $toId = $this->input->post("toId");

        $messages = $this->ChatModel->getMessages($fromId, $toId);
        echo json_encode($messages);
    }

}