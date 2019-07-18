<?php


class AppointmentModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllAppointments(){
        $this->db->from("appointment");
        return $this->db->get()->result();
    }

    function createAppointment($data){
        if ($this->db->insert("appointment", $data)){
            return true;
        }else{
            return false;
        }
    }

    function cancelAppointment($appointment_id){
        $this->db->where("app_id", $appointment_id);
        if ($this->db->delete("appointment")){
            return true;
        }else{
            return false;
        }
    }

    function closeAppointment($appointment_id){
        $this->db->where("app_id", $appointment_id);
        $update = array("display" => "no");
        if ($this->db->update("appointment", $update)){
            return true;
        }else{
            return false;
        }
    }

    function getAppointmentsByDoctor($doctor_id){
        $this->db->select("app_id");
        $this->db->where("doctor_id", $doctor_id);
        $this->db->from("appointment");
        return $this->db->get()->result();
    }

    function getAppointmentsForPatient($patient_id){
        $this->db->select("app_id");
        $this->db->where("patient_id", $patient_id);
        $this->db->from("appointment");
        return $this->db->get()->result();
    }

    function getAppointmentsFor($patient_id){
        $this->db->from("appointment");
        $this->db->where("patient_id", $patient_id);
        return $this->db->get()->result();
    }

    function gotAppointmentAtThisTime($doctor_id, $date, $time){
        $this->db->from("appointment");
        $this->db->where("doctor_id", $doctor_id);
        $this->db->where("sdate", $date);

        $query = $this->db->get();

        $gotAppointment = false;
        $time1 = strtotime(date("1984-01-01 $time"));

        if ($query != null){
            foreach ($query->result() as $appointment){
                $qtime = $appointment->ptime;
                $time2 = strtotime(date("1984-01-01 $qtime"));
                $timeDifference = $time1 - $time2;
                if ($timeDifference < 3600 AND $timeDifference > -3600){
                    $gotAppointment  = true;
                }
            }
        }
        return $gotAppointment;

    }




}