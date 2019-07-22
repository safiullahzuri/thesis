<?php


class DiscussionModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllCommentsFor($scan_id){
        $this->db->where('scan_id', $scan_id);
        $this->db->from('discussion');
        return $this->db->get()->result();
    }

    function addComment($comment){
        if ($this->db->insert('discussion', $comment)){
            return true;
        }else{
            return false;
        }
    }

    function getAllOpenDiscussions(){
        $this->db->distinct();
        $this->db->select('scan_id');
        $this->db->from('discussion');
        $query = $this->db->get()->result();
        return $query;
    }

}