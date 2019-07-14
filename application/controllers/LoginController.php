<?php

class LoginController extends CI_Controller{


    public function __construct()
    {
        parent::__construct();
        $this->load->model("LoginModel");
    }

    function index(){
        $this->login();
    }

    public function login(){

        $this->load->view("signUpIn/login");
    }

    function log(){
        $this->load->view("signUpIn/login");
    }

    public function salam(){
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $userType = $this->input->post("userType");

        $result = $this->LoginModel->login($username, $password, $userType);

        $response = array();

        if ($result != null){
            $response["found"] = "yes";
        }else{
            $response["found"] = "no";
        }
        echo json_encode($response);
    }

    function doctor(){
        echo "i am a doctor";
    }

    function patient(){
        echo "i am a patient";
    }
    function admin(){
        echo "i am an admin";
    }

    function logout(){
        $userId = $this->session->userdata("id");
        $userType = $this->session->userdata("userType");
        $this->checkForBackup($userId, $userType);
        $this->session->sess_destroy();
        redirect("LoginController/login");
    }

    function checkForBackup($userId, $userType){
        if ($userType == 'doctor'){
            if (!$this->BackupModel->gotBackupForLastTwoWeeks($userId, $userType)){
                $this->backupDatabase();
            }
        }
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




















}


?>