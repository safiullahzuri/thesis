<?php


class PatientModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function addPatient($patientData){
        if ($this->db->insert("Patient", $patientData)){
            return true;
        }else{
            return false;
        }
    }

    function getPatientImagePath($patient_id){
        $this->db->from("patient");
        $this->db->where("patient_id", $patient_id);
        $image_name = $this->db->get()->row()->image;
        $image_path = base_url('uploads/avatars/').$image_name;
        return $image_path;
    }

    function getPatientFromAppointment($appointment_id){
        $this->db->where("app_id", $appointment_id);
        $this->db->from("appointment");
        return $this->db->get()->row()->patient_id;
    }

    function getAllPatients(){
        $this->db->from("patient");
        return $this->db->get()->result();
    }

    function editPatient($oldPatientId, $newPatientData){
        $this->db->where("patient_id", $oldPatientId);
        if ($this->db->update("patient", $newPatientData)){
            return true;
        }else{
            return false;
        }
    }

    function getPatient($id){
        $this->db->from("patient");
        $this->db->where("patient_id", $id);
        $query = $this->db->get();
        return $query->row();
    }

    function deletePatient($id){
        $this->db->where("patient_id", $id);
        if ($this->db->delete("patient")){
            return true;
        }else{
            return false;
        }
    }

}