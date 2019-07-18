<?php


class ReportController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library("zip");
        $this->load->library("pdf");

    }

    function sendReport(){
        $appointment_id = $this->uri->segment(3);
        $file_name = $this->DiagnosisModel->getDiagnosisPath($appointment_id);
        $diagnosis_content = file_get_contents($file_name);
        $data["scans"] = $this->ScanModel->getAllScans($appointment_id);
        $data["diagnosis_content"] = $diagnosis_content;
        $data["appointment_id"] = $appointment_id;
        $this->load->view("Report/send", $data);
    }


    function sendZipFileMassEmail(){
        $recipients = $this->input->post('recipients');
        $appointment_id = $this->input->post("appointment_id");
        //TODO: generate pdf
        $pdf = $this->generateReportPdf($appointment_id);
        //TODO: zip the scans and add the pdf report file to zipped folder
        $pdf_file_contents = file_get_contents($pdf);

        $this->zip->add_data("report.pdf", $pdf_file_contents);

        //Todo: get the scans, add them to the zip folder
        $scans = $this->ScanModel->getAllScans($appointment_id);
        foreach ($scans as $scan){
            $scan_address = base_url("uploads/scans/").$scan->file_name;
            $this->zip->add_data($scan->file_name, file_get_contents($scan_address));
        }


        $zip_location = $_SERVER["DOCUMENT_ROOT"]."pacs/uploads/zips/".time().'.zip';
        $this->zip->archive($zip_location);


        //TODO: get all emails and mass email to the address you receive to this controller method

        $config = array();
        $config['useragent']           = "CodeIgniter";
        $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']            = "smtp";
        $config['smtp_host']           = "ssl://smtp.googlemail.com";
        $config['smtp_port']           = "465";
        $config['smtp_user']           = "hanif.safi9@gmail.com";
        $config['smtp_pass']           = "suheyb123suheyb123";
        $config['mailtype']            = 'html';
        $config['charset']             = 'utf-8';
        $config['newline']             = "\r\n";
        $config['wordwrap']            = TRUE;

        $this->load->library('email');

        $this->email->initialize($config);

        $this->email->from("hanif.safi9@gmail.com", "Safiullah Zuri");
        $this->email->to($recipients);

        $this->email->subject('Diagnosis Docuents');

        $message = '<html><head></head><body><h1>Dear'.getPatientsNameFromAppointment($appointment_id).'</h1><p>Please receive your diagnosis with your scans.</p></body></html>';

        $this->email->message($message);

        if ($this->email->attach($zip_location)){
            echo "attached";
        }else{
            echo "not attached";
        }

        if ($this->email->send()){
            redirect("DoctorController");
        }else{
            echo $this->email->print_debugger();
        }
    }


    function generateReportPdf($appointment_id){
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Diagnosis Report');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Safiullah Zuri');
        $pdf->SetDisplayMode('real', 'default');

        // hard coded data
        $patient_picture = $this->PatientModel->getPatientImagePath($this->PatientModel->getPatientFromAppointment($appointment_id));
        $doctor_picture = $this->DoctorModel->getDoctorImagePath($this->DoctorModel->getDoctorFromAppointment($appointment_id));

        $pdf->AddPage();

        $patientId = $this->PatientModel->getPatientFromAppointment($appointment_id);
        $html = '<html><body><div class="container container-fluid">
                    <div class="row">
                        <div class="col-md-8 align-items-center align-content-center">
                            <h1>Diagnosis Report For '.getPatientsName($patientId).'</h1>
                            <img src="'.$this->PatientModel->getPatientImagePath($patientId).'">
                        </div>
                    </div>
                 </div>';

        $html .= '<div class="row"><div class="col-md-8 align-content-center align-items-center">
                        <div class="alert alert-info">The Following diagnosis has been made with regards to the problems associated with the following scans.</div>
                        <div class="jumbotron">'.file_get_contents($this->DiagnosisModel->getDiagnosisPath($appointment_id)).'</div>
                  </div></div>';
        $scans_location = $_SERVER["DOCUMENT_ROOT"]."pacs/uploads/scans/";

        $scans = $this->ScanModel->getAllScans($appointment_id);

        $html .= '<div class="row"><div class="col-md-8 align-items-center align-content-center">';

        foreach ($scans as $scan){
            $html.= '<img class="thumbnail" width="75" height="75" src="'.$scans_location.$scan->file_name.'">';
        }

        $html .= '<div class="row"><div class="col-md-8 footer"><span>Signature</span><img class="pull-right" src="'.$doctor_picture.'" /> </div>';

        $html  .= '</div></div></body></html>';


        $pdf->writeHTML($html, true, 0, true, 0);

        $file_location_name = $_SERVER["DOCUMENT_ROOT"]."pacs/uploads/reports/".time().'.pdf';

        $pdf->Output($file_location_name, 'F');
        return $file_location_name;
    }




    function generateReport(){
        $appointment_id = $this->uri->segment(3);
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('My Title');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');

        $patientId = $this->PatientModel->getPatientFromAppointment($appointment_id);

        $patient_picture = $this->PatientModel->getPatientImagePath($patientId);
        $doctor_picture = $this->DoctorModel->getDoctorImagePath($this->DoctorModel->getDoctorFromAppointment($appointment_id));

        $pdf->AddPage();
        // output the HTML content

        $html = '<html><body><div class="container container-fluid">
                    <div class="row">
                        <div class="col-md-8 align-items-center align-content-center">
                            <h1>Diagnosis Report For '.getPatientsName($patientId).'</h1>
                            <img width="100" height="100" src="'.$this->PatientModel->getPatientImagePath($patientId).'">
                        </div>
                    </div>

                 </div>';

        $html .= '<div class="row"><div class="col-md-8 align-content-center align-items-center">
                        <div class="alert alert-info">The Following diagnosis has been made with regards to the problems associated with the following scans.</div>
                        <div class="jumbotron">'.file_get_contents($this->DiagnosisModel->getDiagnosisPath($appointment_id)).'</div>
                  </div></div>';
        $scans_location = $_SERVER["DOCUMENT_ROOT"]."pacs/uploads/scans/";

        $scans = $this->ScanModel->getAllScans($appointment_id);

        $html .= '<div class="row"><div class="col-md-8 align-items-center align-content-center">';

        foreach ($scans as $scan){
            $html.= '<img class="thumbnail" width="75" height="75" src="'.$scans_location.$scan->file_name.'">';
        }

        $html .= '<div class="row"><div class="col-md-8 footer"><span>Signature</span><img width="100" height="100" class="pull-right" src="'.$doctor_picture.'" /> </div>';

        $html  .= '</div></div></body></html>';


        $pdf->writeHTML($html, true, 0, true, 0);

        $file_location_name = $_SERVER["DOCUMENT_ROOT"]."pacs/uploads/reports/".time().'.pdf';

        $pdf->Output($file_location_name, 'D');
    }







    function createZipFolder(){
        $scans_for_appointment = $this->ScanModel->getScansForAppointment(4);
        foreach($scans_for_appointment as $scan){
            $scan_image = $scan->file_name;
            $path = base_url('uploads/scans/').$scan_image;
            $this->zip->add_data($scan_image, file_get_contents($path));
        }
        $zip_file = $this->zip->get_zip();
        return $zip_file;
    }





}