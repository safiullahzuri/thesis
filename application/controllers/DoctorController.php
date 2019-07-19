<?php


class DoctorController extends CI_Controller
{
    private $doctor_id;

    function __construct()
    {
        parent::__construct();
        $this->init();

        if ($this->session->has_userdata("id") && $this->session->userdata("userType") == 'doctor'){
            $this->doctor_id = $this->session->userdata("id");
        }else{
            redirect("LoginController/login");
        }
    }

    function changePassword(){
        $previousPassword = $this->input->post("previousPassword");
        $doctorId = $this->input->post("doctorId");
        $newPassword = $this->input->post("newPassword");
        if ($this->DoctorModel->changePassword($doctorId, $previousPassword, $newPassword)){
            $message = "You successfully changed your password!";
        }else{
            $message = "Something wrong with your password. Please ensure that your password is correct.";
        }
        $this->session->set_flashdata("changePasswordMessage", $message);
        $this->myAccount();
    }

    function index(){
        redirect('DoctorController/myAppointments');
    }

    function backupDatabase(){
        $this->load->dbutil();
        $prefs = array(
            "format" => "zip",
            "filename" => "my_db_backup.sql"
        );

        $backup = & $this->dbutil->backup($prefs);
        $db_name = 'backup-on-'.date('Y-m-d-H-i-s').'.zip';
        $save = './uploads/backups/'.$db_name;

        $userId = $this->session->userdata("id");
        $userType = $this->session->userdata("userType");

        if ($this->BackupModel->addBackup($db_name, $userId, $userType)){

            write_file($save, $backup);
            force_download($db_name, $backup);
        }else{
            echo '<script>alert("Sorry! Could not back up your database.");</script>';
        }
    }





    function myAllDiagnosis(){
        $myAllDiagnosis = $this->DiagnosisModel->getAllDiagnosisByDoctor($this->doctor_id);
        echo json_encode($myAllDiagnosis);
    }

    function register(){
        $this->load->view("Doctor/register");
    }

    function view(){
        $this->load->view("Doctor/view");
    }

    function doctors(){
        $doctors = $this->m->getAllDoctors();
        echo json_encode($doctors);
    }

    function edit(){
        $doctor_id = $this->input->post("doctor_id");
        $username = $this->input->post("username");
        $password = md5($this->input->post("password"));
        $firstname = encrypt($this->input->post("firstname"));
        $lastname = encrypt($this->input->post("lastname"));
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
                //call the model method

                $imageName = $_FILES['image']['name'];

                $doctorData = array("username"=>$username, "password" => $password, "firstname" => $firstname, "lastname" => $lastname, "dob" => $dob, "city" => $city, "street" => $street,
                    "email" => $email, "postCode" => $postcode, "phoneNo" => $phoneNo, "image" => $imageName
                );

                if ($this->DoctorModel->editDoctor($doctor_id, $doctorData)){
                    echo "Edited successfully";
                }else{
                    echo "Could not edit";
                }
            }
        }else{
            //TODO: just update the record and do not change the previous path to image
            $newDoctorData = array("username"=>$username, "password" => $password, "firstname" => $firstname, "lastname" => $lastname, "dob" => $dob, "city" => $city, "street" => $street,
                "email" => $email, "postCode" => $postcode, "phoneNo" => $phoneNo
            );
            if ($this->DoctorModel->editDoctor($doctor_id, $newDoctorData)){
                echo "Edited successfully";
            }else{
                echo "Could not edit";
            }
        }

    }

    function delete(){
        $id = $this->input->post("id");
        if ($this->DoctorModel->deleteDoctor($id)){
            echo "Deleted successfully";
        }else{
            echo "could not delete";
        }
    }

    function doctor(){
        $id = $this->input->post("id");
        $doctor = $this->DoctorModel->getDoctor($id);
        echo json_encode($doctor);
    }

    function createDoctor(){
        $username = $this->input->post("username");
        $password = md5($this->input->post("password"));
        $firstname = encrypt($this->input->post("firstname"));
        $lastname = encrypt($this->input->post("lastname"));
        $dob = $this->input->post("dob");
        $city = $this->input->post("city");
        $street = $this->input->post("street");
        $email = $this->input->post("email");
        $postcode = encrypt($this->input->post("postCode"));
        $phoneNo = $this->input->post("phoneNo");

        if (!$this->upload->do_upload("image")) {
            echo $this->upload->display_errors();
        } else {
            $imageData = $this->upload->data();
            //call the model method

            $imageName = encrypt($imageData["file_name"]);

            $doctorData = array("username"=>$username, "password" => $password, "firstname" => $firstname, "lastname" => $lastname, "dob" => $dob, "city" => $city, "street" => $street,
                "email" => $email, "postCode" => $postcode, "phoneNo" => $phoneNo, "image" => $imageName
            );

            if ($this->m->addDoctor($doctorData)) {
                echo "Doctor successfully added";
            } else {
                echo "Doctor was not added";
            }


        }
    }

    function myAccount(){
        $data["doctor"] = $this->DoctorModel->getDoctor($this->doctor_id);
        $this->load->view("doctor/my_account", $data);
    }


    function sendReports(){
        $myDiagnosis = $this->DiagnosisModel->getAllDiagnosisByDoctor($this->doctor_id);
        $array = json_decode(json_encode($myDiagnosis), true);
        $data["myDiagnosis"] = $array;
        $this->load->view("doctor/send_report", $data);
    }

    function init(){
        $config['upload_path'] = './uploads/avatars/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '2056';
        $config['max_height'] = '2056';
        $this->upload->initialize($config);
    }


    function myAppointments(){
        $data["myAppointments"] = $this->DoctorModel->getAppointmentsForDoctor($this->doctor_id);
        $data["doctor_id"] = $this->doctor_id;
        $this->load->helper("Appointment");
        $this->load->view("Doctor/appointment", $data);
    }

    function getScans(){
        $appointment_id = $this->uri->segment(3);
        $scans = $this->ScanModel->getScansForAppointment($appointment_id);
        $data["scans"] = $scans;
        $this->load->view("doctor/scans", $data);
    }


    //TODO: My diagnosis
    function myDiagnosis(){
        $myDiagnosis = $this->DiagnosisModel->getAllDiagnosisByDoctor($this->doctor_id);
        $array = json_decode(json_encode($myDiagnosis), true);
        $data["myDiagnosis"] = $array;
        $this->load->view("doctor/my_diagnosis", $data);
    }

    function mySchedule(){
        $data["myAppointments"] = $this->DoctorModel->getDoctorSchedule($this->doctor_id);
        $data["doctor_id"] = $this->doctor_id;
        $this->load->helper("Appointment");
        $this->load->view("Doctor/schedule", $data);
    }

    function myScans(){
        $scans = $this->ScanModel->getScansByDoctor($this->doctor_id);

        $array = json_decode(json_encode($scans), true);

        $data["scans"] = $array;

        $this->load->view("doctor/all_scans", $data);
    }






}