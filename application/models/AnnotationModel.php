<?php


class AnnotationModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllAnnotationsFor($scan_id){
        $this->db->from('annotation');
        $this->db->where('scan_id', $scan_id);
        $query = $this->db->get();
        return $query->result();
    }

    function addAnnotation($annotation){
        if ($this->db->insert('annotation', $annotation)){
            return true;
        }else{
            return false;
        }
    }

}