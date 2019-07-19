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

    function changePassword($patientId, $previousPassword, $newPassword){
        if ($this->isPasswordCorrect($patientId, $previousPassword)){
            $this->db->where("patient_id", $patientId);
            if ($this->db->update("patient", array("password" => md5($newPassword)))){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function isPasswordCorrect($patientId, $password){
        $this->db->from("patient");
        $this->db->where("patient_id", $patientId);
        $patientPassword = $this->db->get()->row()->password;
        if ($patientPassword == md5($password)){
            return true;
        }else{
            return false;
        }
    }

    function getPatientImagePath($patient_id){
        $this->db->from("patient");
        $this->db->where("patient_id", $patient_id);
        $image_name = $this->db->get()->row()->image;
        $image_name = decrypt($image_name);
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
        $patients =  $this->db->get()->result();
        foreach ($patients as $patient){
            $patient->firstname = decrypt($patient->firstname);
            $patient->lastname = decrypt($patient->lastname);
            $patient->image = decrypt($patient->image);
            $patient->postCode = decrypt($patient->postCode);
        }
        return $patients;
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
        $patient = $query->row();
        $patient->firstname = decrypt($patient->firstname);
        $patient->lastname = decrypt($patient->lastname);
        $patient->image = decrypt($patient->image);
        $patient->postCode = decrypt($patient->postCode);
        return $patient;
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