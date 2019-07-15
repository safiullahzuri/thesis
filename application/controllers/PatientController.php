<?php


class PatientController extends CI_Controller
{

    private $patient_id;

    function __construct()
    {
        parent::__construct();
        $this->init();


        if ($this->session->has_userdata("id") && $this->session->userdata("userType") == 'patient'){
             $this->patient_id = $this->session->userdata("id");
        }else{
            redirect("LoginController/login");
        }

    }

    function index()
    {
        $this->myAppointments();
    }

    function myAppointments(){
        $data["myAppointments"] = $this->AppointmentModel->getAppointmentsFor($this->patient_id);

        $this->load->view("patient/my_appointments", $data);
    }

    function myDiagnosis(){
        $myDiagnosis = $this->DiagnosisModel->getAllPatientDiagnosis($this->patient_id);


        $array = json_decode(json_encode($myDiagnosis), true);

        $data["myDiagnosis"] = $array;


        $this->load->view("patient/my_diagnosis", $data);
    }

    function myScans(){
        $scans = $this->ScanModel->getScansForPatient($this->patient_id);



        $array = json_decode(json_encode($scans), true);


        $data["scans"] = $array;


        $this->load->view("patient/all_scans", $data);
    }


    function myAccount(){

        $data["patient"] = $this->PatientModel->getPatient($this->patient_id);
        $this->load->view("patient/my_account", $data);
    }

    function bookAnAppointment(){
        $data["patient_id"] = $this->patient_id;
        $data["doctors"] = $this->DoctorModel->getAllDoctors();;
        $this->load->view("Patient/book", $data);
    }

    function registerPatient()
    {
        $this->load->view("Patient/register");
    }

    function deletePatient()
    {
        $id = $this->input->post("id");
        if ($this->m->deletePatient($id)){
            echo "Deleted successfully";
        }else{
            echo "Could not delete";
        }
    }

    function getScans(){
        $appointment_id = $this->uri->segment(3);
        $scans = $this->ScanModel->getScansForAppointment($appointment_id);
        $data["scans"] = $scans;
        $this->load->view("patient/scans", $data);
    }

    function init(){
        $config['upload_path'] = './uploads/avatars/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '2056';
        $config['max_height'] = '2056';
        $this->upload->initialize($config);
    }

    function edit()
    {
        $patient_id = $this->input->post("patient_id");
        $username = $this->input->post("username");
        $firstname = encrypt($this->input->post("firstname"));
        $lastname = encrypt($this->input->post("lastname"));
        $job = $this->input->post("job");
        $dob = $this->input->post("dob");
        $city = $this->input->post("city");
        $street = $this->input->post("street");
        $email = $this->input->post("email");
        $postcode = encrypt($this->input->post("postCode"));
        $phoneNo = $this->input->post("phoneNo");

        $newImage = encrypt($this->input->post("newImage"));

        if ($newImage == "true"){
            //TODO: upload new image and update the record
            if (!$this->upload->do_upload("image")){
                echo $this->upload->display_errors();
            }else{
                $imageData = $this->upload->data();
                //call the model method

                $imageName = $_FILES['image']['name'];

                $patientData = array("username"=>$username, "firstname" => $firstname, "lastname" => $lastname, "job" => $job, "dob" => $dob, "city" => $city, "street" => $street,
                    "email" => $email, "postCode" => $postcode, "phoneNo" => $phoneNo, "image" => $imageName
                );

                if ($this->PatientModel->editPatient($patient_id, $patientData)){
                    echo "Edited successfully";
                }else{
                    echo "Could not edit";
                }

            }



        }else{
            //TODO: just update the record and do not change the previous path to image
            $newPatientData = array("username"=>$username, "firstname" => $firstname, "lastname" => $lastname, "job" => $job, "dob" => $dob, "city" => $city, "street" => $street,
                "email" => $email, "postCode" => $postcode, "phoneNo" => $phoneNo
            );
            if ($this->PatientModel->editPatient($patient_id, $newPatientData)){
                echo "Edited successfully";
            }else{
                echo "Could not edit";
            }
        }



    }

    function view()
    {

        $this->load->view("Patient/view");

    }

    function patient()
    {
        $id = $this->input->post("id");
        echo json_encode($this->PatientModel->getPatient($id));
    }

    function patients(){
        echo json_encode($this->m->getAllPatients());
    }

    function register()
    {
        $username = $this->input->post("username");
        $password = md5($this->input->post("password"));
        $firstname = encrypt($this->input->post("firstname"));
        $lastname = encrypt($this->input->post("lastname"));
        $job = $this->input->post("job");
        $dob = $this->input->post("dob");
        $city = $this->input->post("city");
        $street = $this->input->post("street");
        $email = $this->input->post("email");
        $postcode = encrypt($this->input->post("postCode"));
        $phoneNo = $this->input->post("phoneNo");

        $config['upload_path'] = './uploads/avatars/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '2056';
        $config['max_height'] = '2056';


// Alternately you can set preferences by calling the ``initialize()`` method. Useful if you auto-load the class:
        $this->upload->initialize($config);


        if (!$this->upload->do_upload("image")) {
            echo $this->upload->display_errors();
        } else {
            $imageData = $this->upload->data();
            //call the model method

            $imageName = encrypt($imageData["file_name"]);

            $patientData = array("username"=>$username, "password" => $password, "firstname" => $firstname, "lastname" => $lastname, "job" => $job, "dob" => $dob, "city" => $city, "street" => $street,
                "email" => $email, "postCode" => $postcode, "phoneNo" => $phoneNo, "image" => $imageName
            );

            if ($this->m->addPatient($patientData)) {
                echo "patient successfully added";
            } else {
                echo "patient was not added";
            }


        }


    }

    function uploadPatientImage()
    {

    }


}