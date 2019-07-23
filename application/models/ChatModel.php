<?php


class ChatModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function addMessage($chatMessage){
        if ($this->db->insert('chats', $chatMessage)){
            return true;
        }else{
            return false;
        }
    }

    function getMessages($fromId, $toId){
        $this->db->from('chats');
        $this->db->where('from_id', $fromId);
        $this->db->where('to_id', $toId);
        $this->db->order_by('message_id', 'desc');

        $query = $this->db->get();
        return $query->result();
    }

}