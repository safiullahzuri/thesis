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

    function changePassword($adminId, $previousPassword, $newPassword){
        if ($this->isPasswordCorrect($adminId, $previousPassword)){
            $this->db->where("doctor_id", $adminId);
            if ($this->db->update("doctor", array("password" => md5($newPassword)))){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function isPasswordCorrect($adminId, $password){
        $this->db->from("admin");
        $this->db->where("admin_id", $adminId);
        $patientPassword = $this->db->get()->row()->password;
        if ($patientPassword == md5($password)){
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