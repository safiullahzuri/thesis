<?php

class DoctorModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getDoctorImage($doctor_id){
        $this->db->where('doctor_id', $doctor_id);
        $this->db->from('doctor');
        $doctor = $this->db->get()->row();
        $image = decrypt($doctor->image);
        $address = base_url('uploads/avatars/').$image;
        return $address;
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
        $image_name = decrypt($image_name);
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
        $doctors =  $this->db->get()->result();
        foreach ($doctors as $doctor){
            $doctor->firstname = decrypt($doctor->firstname);
            $doctor->lastname = decrypt($doctor->lastname);
            $doctor->image = decrypt($doctor->image);
            $doctor->postCode = decrypt($doctor->postCode);
        }
        return $doctors;
    }

    function getDoctor($id){
        $this->db->from("doctor");
        $this->db->where("doctor_id", $id);
        $query = $this->db->get();
        $doctor = $query->row();
        $doctor->firstname = decrypt($doctor->firstname);
        $doctor->lastname = decrypt($doctor->lastname);
        $doctor->image = decrypt($doctor->image);
        $doctor->postCode = decrypt($doctor->postCode);
        return $doctor;
    }

    function changePassword($doctorId, $previousPassword, $newPassword){
        if ($this->isPasswordCorrect($doctorId, $previousPassword)){
            $this->db->where("doctor_id", $doctorId);
            if ($this->db->update("doctor", array("password" => md5($newPassword)))){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function isPasswordCorrect($doctorId, $password){
        $this->db->from("doctor");
        $this->db->where("doctor_id", $doctorId);
        $patientPassword = $this->db->get()->row()->password;
        if ($patientPassword == md5($password)){
            return true;
        }else{
            return false;
        }
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