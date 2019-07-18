<?php


class AppointmentController extends CI_Controller
{
    private $doctors_list;

    function __construct()
    {
        parent::__construct();
        $this->doctors_list = $this->DoctorModel->getAllDoctors();
    }

    function index(){
        echo "appointment";
    }

    function cancel(){
        $appointment_id = $this->input->post("id");

        $response["cancelled"] = "no";
        if ($this->AppointmentModel->cancelAppointment($appointment_id)){
            $response["cancelled"] = "yes";
        }
        echo json_encode($response);
    }


    function make(){
        $patient_id = $this->input->post("patient_id");
        $doctor_id = $this->input->post("doctor_id");
        $date = $this->input->post("date");
        $time = $this->input->post("time");
        $desc = $this->input->post("desc");

        $appointment = array("patient_id" => $patient_id, "doctor_id" => $doctor_id, "sdate" => $date, "ptime" => $time, "description" => $desc, "display" => "yes");

        if (!$this->AppointmentModel->gotAppointmentAtThisTime($doctor_id, $date, $time)){
            if ($this->AppointmentModel->createAppointment($appointment)){
                echo "Appointment made successfully";
            }else{
                echo "Sorry! Could not make the appointment!";
            }
        }else{
            echo "The doctor has already an appointment at this time.";
        }
    }

    function appointment(){
        $doctor_id = $this->uri->segment(3);
        $appointment_id = $this->uri->segment(4);
        $data["doctor_id"] = $doctor_id;
        $data["appointment_id"] = $appointment_id;
        $this->load->view("scan/upload", $data);
    }
}