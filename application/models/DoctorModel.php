<?php

class DoctorModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getDoctorFromAppointment($appointment_id){
        $this->db->where("app_id", $appointment_id);
        $this->db->from("appointment");
        return $this->db->get()->row()->patient_id;
    }

    function getDoctorImagePath($doctor_id){
        $this->db->from("doctor");
        $this->db->where("doctor_id", $doctor_id);
        $image_name = $this->db->get()->row()->image;
        $image_path = base_url('uploads/avatars/').$image_name;
        return $image_path;
    }

    function addDoctor($doctorData){
        if ($this->db->insert("doctor", $doctorData)){
            return true;
        }else{
            return false;
        }
    }

    function getAllDoctors(){
        $this->db->from("doctor");
        return $this->db->get()->result();
    }

    function getDoctor($id){
        $this->db->from("doctor");
        $this->db->where("doctor_id", $id);
        $query = $this->db->get();
        return $query->row();
    }

    function deleteDoctor($id){
        $this->db->where("doctor_id", $id);
        if ($this->db->delete("doctor")){
            return true;
        }else {
            return false;
        }
    }

    function editDoctor($id, $newDoctorData){
        $this->db->where("doctor_id", $id);
        if ($this->db->update("doctor", $newDoctorData)){
            return true;
        }else{
            return false;
        }
    }

    function getAppointmentsForDoctor($doctorId){
        $this->db->from("appointment");
        $this->db->where("doctor_id", $doctorId);
        return $this->db->get()->result();
    }

    function getDoctorSchedule($doctorId){
        $this->db->from("appointment");
        $this->db->where("doctor_id", $doctorId);
        $this->db->where("display", "yes");
        return $this->db->get()->result();
    }

}