<?php


class AdminModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function addAdmin($adminData){
        if ($this->db->insert("admin", $adminData)){
            return true;
        }else{
            return false;
        }
    }

    function getAllAdmins(){
        $this->db->from("admin");
        $admins =  $this->db->get()->result();
        foreach ($admins as $admin){
            $admin->firstname = decrypt($admin->firstname);
            $admin->lastname = decrypt($admin->lastname);
            $admin->image = decrypt($admin->image);
        }
    }

    function deleteAdmin($id){
        $this->db->where("admin_id", $id);
        if ($this->db->delete("admin")){
            return true;
        }else{
            return false;
        }
    }

    function getAdmin($id){
        $this->db->from("admin");
        $this->db->where("admin_id", $id);
        $admin =  $this->db->get()->row();
        $admin->firstname = decrypt($admin->firstname);
        $admin->lastname = decrypt($admin->lastname);
        $admin->image = decrypt($admin->image);
        return $admin;
    }

    function editAdmin($id, $data){
        $this->db->where("admin_id", $id);
        if ($this->db->update("admin", $data)){
            return true;
        }else{
            return false;
        }
    }

}