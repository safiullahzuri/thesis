<?php


class DiagnosisModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getAllDiagnosis(){
        $this->db->from("diagnosis");
        return $this->db->get()->result();
    }

    function addDiagnosis($appointment_id, $diagnosis_file){
        $diagnosis = array("appointment_id" => $appointment_id, "diagnosis_file" => $diagnosis_file);
        if ($this->db->insert("diagnosis", $diagnosis)){
            return true;
        }else{
            return false;
        }
    }



    function isDiagnosisForAppointment($appointment_id){
        $this->db->where("appointment_id", $appointment_id);
        $this->db->from("diagnosis");
        $query =  $this->db->get();
        if ($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function updateDiagnosis($appointment_id, $diagnosis_file){
        $diagnosis = array("appointment_id" => $appointment_id, "diagnosis_file" => $diagnosis_file);
        $this->db->where("diagnosis_id", $this->getDiagnosis($appointment_id)->diagnosis_id);
        if ($this->db->update("diagnosis", $diagnosis)){
            return true;
        }else{
            return false;
        }
    }

    function getDiagnosis($appointment_id){
        $this->db->where("appointment_id", $appointment_id);
        $this->db->from("diagnosis");
        $query =  $this->db->get();
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return null;
        }
    }


    //TODO: get diagnosis path for an appointment
    function getDiagnosisPath($appointment_id){
        $this->db->where("appointment_id", $appointment_id);
        $this->db->from("diagnosis");
        $diagnosis_file = $this->db->get()->row()->diagnosis_file;
        return FCPATH.'uploads/diagnosis/'.$appointment_id.'/'.$diagnosis_file;
    }


    //TODO: GET my all diagnosis
    function getAllDiagnosisByDoctor($doctor_id){
        //todo: get all appointments by doctor_id

        $my_appointments = $this->AppointmentModel->getAppointmentsByDoctor($doctor_id);

        //todo: create an array, loop through the list of appointments above
        //todo: and add to a new array the diagnosis on that appointment
        $my_diagnosis = array();

        foreach ($my_appointments as $appointment){
            if ($this->getDiagnosis($appointment->app_id) != null){
                array_push($my_diagnosis, $this->getDiagnosis($appointment->app_id));
            }
        }

        return $my_diagnosis;

    }


    function getAllPatientDiagnosis($patient_id){
        $my_appointments = $this->AppointmentModel->getAppointmentsForPatient($patient_id);
        $my_diagnosis = array();
        foreach ($my_appointments as $appointment){
            if ($this->getDiagnosis($appointment->app_id) != null){
                array_push($my_diagnosis, $this->getDiagnosis($appointment->app_id));
            }
        }
        return $my_diagnosis;
    }



}