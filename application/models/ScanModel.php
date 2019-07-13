<?php


class ScanModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function addScan($file_name, $scan_desc, $appointment_id){
        $scan_data = array("file_name" => $file_name, "scan_desc" => $scan_desc, "appointment_id" => $appointment_id);
        if ($this->db->insert("scan", $scan_data)){
            return true;
        }else{
            return false;
        }
    }

    function getAllScans($appointment_id){
        $this->db->where("appointment_id", $appointment_id);
        $this->db->from("scan");
        $query = $this->db->get();
        return $query->result();
    }

    function getScansForAppointment($appointment_id){
        $this->db->where("appointment_id", $appointment_id);
        $this->db->from("scan");
        return $this->db->get()->result();
    }

    //get scans for patient
    function getScansForPatient($patient_id){

        //todo: get appointments where patient id equals value above
        $my_appointments = $this->AppointmentModel->getAppointmentsForPatient($patient_id);
        $scans = array();
        foreach ($my_appointments as $appointment){
            if ($this->getAllScans($appointment->app_id) != null){
                array_push($scans, $this->getAllScans($appointment->app_id));
            }
        }
        return $scans;
    }


    //get scans for patient
    function getScansByDoctor($doctor_id){

        //todo: get appointments where patient id equals value above
        $my_appointments = $this->AppointmentModel->getAppointmentsByDoctor($doctor_id);
        $scans = array();
        foreach ($my_appointments as $appointment){
            if ($this->getAllScans($appointment->app_id) != null){
                array_push($scans, $this->getAllScans($appointment->app_id));
            }
        }
        return $scans;
    }





}