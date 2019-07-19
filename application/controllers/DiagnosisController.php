<?php


class DiagnosisController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function saveDiagnosis(){
        $appointment_id = $this->input->post("appointment_id");
        $diagnosis_text = $this->input->post("diagnosis_text");

        $data["wrote"] = "no";

        if (!is_dir("Uploads/diagnosis/$appointment_id")){
            mkdir("./Uploads/diagnosis/$appointment_id", 0777, true);
        }

        $date = date("Y-m-d-h-i-s");

        $file_name = $date.'diagnosis.txt';

        if (write_file("./Uploads/diagnosis/$appointment_id/$file_name", $diagnosis_text)){

            //check if there is a diagnosis for this appointment before,
            //if so update rather than saving it again

            if ($this->DiagnosisModel->isDiagnosisForAppointment($appointment_id)){
                $this->DiagnosisModel->updateDiagnosis($appointment_id, $file_name);
                $data["wrote"] = "yes";
            }else{
                if ($this->DiagnosisModel->addDiagnosis($appointment_id, $file_name)){
                    $data["wrote"] = "yes";
                }
            }

            $this->AppointmentModel->closeAppointment($appointment_id);
        }

        echo json_encode($data);
    }

    function getDiagnosis(){
        $appointment_id = $this->input->post("id");
        $contents = "";
        $contents = file_get_contents($this->DiagnosisModel->getDiagnosisPath($appointment_id), true);
        echo $contents;

    }

    function editDiagnosis(){
        $appointmentId = $this->input->post("appointmentId");
        $diagnosisText = $this->input->post("diagnosisText");

        if (write_file($this->DiagnosisModel->getDiagnosisPath($appointmentId), $diagnosisText, 'w+')){
            echo "edited";
        }else{
            echo FCPATH;
            echo "not edited".$this->DiagnosisModel->getDiagnosisPath($appointmentId);
        }

    }

}