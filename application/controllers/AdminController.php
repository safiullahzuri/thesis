<?php

class AdminController extends CI_Controller
{

    private $admin_id;

    function __construct()
    {
        parent::__construct();
        $this->init();
        $this->load->view("admin/navigation");

        if ($this->session->has_userdata("id") && $this->session->userdata("userType") == "admin"){
            $this->admin_id = $this->session->userdata("id");
        }else{
            redirect("LoginController/login");
        }
    }

    function index(){
        $this->managePatients();
    }


    function managePatients(){

        $this->load->view("admin/manage_patients");
    }

    function manageDoctors(){
        $this->load->view("admin/all_doctors");
    }

    function manageAppointments(){
        $data["appointments"] = $this->AppointmentModel->getAllAppointments();
        $this->load->view("admin/all_appointments", $data);
    }

    function getScans(){
        $appointment_id = $this->uri->segment(3);
        $scans = $this->ScanModel->getScansForAppointment($appointment_id);
        $data["scans"] = $scans;
        $this->load->view("admin/scans", $data);
    }

    function manageDiagnosis(){
        $myDiagnosis = $this->DiagnosisModel->getAllDiagnosis();
        $data["myDiagnosis"] = $myDiagnosis;
        $this->load->view("admin/all_diagnosis", $data);
    }

    function myAccount(){
        $data["admin"] = $this->AdminModel->getAdmin($this->admin_id);
        $this->load->view("admin/my_account", $data);
    }

























    function register(){
        $this->load->view("Admin/register");
    }

    function view(){
        $this->load->view("Admin/view");
    }

    function admins(){
        echo json_encode($this->AdminModel->getAllAdmins());
    }

    function admin(){
        echo json_encode($this->AdminModel->getAdmin($this->input->post("id")));
    }

    function edit(){

        $admin_id = $this->input->post("admin_id");
        $username = $this->input->post("username");
        $firstname = $this->input->post("firstname");
        $lastname = $this->input->post("lastname");
        $newImage = $this->input->post("newImage");

        if ($newImage == "true"){
            //TODO: upload new image and update the record
            if (!$this->upload->do_upload("image")){
                echo $this->upload->display_errors();
            }else{
                $imageData = $this->upload->data();
                //call the model method

                $imageName = $_FILES['image']['name'];

                $doctorData = array("username"=>$username, "firstname" => $firstname, "lastname" => $lastname,
                     "image" => $imageName
                );

                if ($this->m->editAdmin($admin_id, $doctorData)){
                    echo "Edited successfully";
                }else{
                    echo "Could not edit";
                }
            }
        }else{
            //TODO: just update the record and do not change the previous path to image
            $doctorData = array("username"=>$username, "firstname" => $firstname, "lastname" => $lastname
            );
            if ($this->m->editAdmin($admin_id, $doctorData)){
                echo "Edited successfully";
            }else{
                echo "Could not edit";
            }
        }
    }

    function delete(){
        $id = $this->input->post("id");
        if ($this->m->deleteAdmin($id)){
            echo "Deleted successfully";
        }else{
            echo "could not delete";
        }
    }


    function createAdmin(){

        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $firstname = $this->input->post("firstname");
        $lastname = $this->input->post("lastname");

        if (!$this->upload->do_upload("image")) {
            echo $this->upload->display_errors();
        } else {
            $imageData = $this->upload->data();
            //call the model method

            $imageName = $imageData["file_name"];

            $adminData = array("username"=>$username, "password" => $password, "firstname" => $firstname, "lastname" => $lastname,
                 "image" => $imageName
            );

            if ($this->m->addAdmin($adminData)) {
                echo "Doctor successfully added";
            } else {
                echo "Doctor was not added";
            }


        }
    }

    function init(){
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '2056';
        $config['max_height'] = '2056';
        $this->upload->initialize($config);
    }

    function editAdmin(){

    }

    function deleteAdmin(){

    }

    function getAllAdmins(){


    }

    function getAdmin(){

    }

}

?>