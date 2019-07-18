<?php


class LoginModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function login($username, $password, $userType){

        $this->db->from($userType);
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));

        $person = $this->db->get()->row();

        if ($userType == "patient"){
            $id = $person->patient_id;
        }else if ($userType == "doctor"){
            $id = $person->doctor_id;
        }else if ($userType == "admin"){
            $id = $person->admin_id;
        }else{
            $id = null;
        }



        if ($person != null){
            $personData = array(
                "id" => $id,
                "userType" => $userType,
                "username" => $person->username,
                "firstname" => decrypt($person->firstname),
                "lastname" => decrypt($person->lastname),
                "logged_in" => TRUE
            );

            $this->session->set_userdata($personData);
            return $person;
        }else{
            return false;
        }

    }

}