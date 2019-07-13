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
        $this->session->sess_destroy();
        redirect("LoginController/login");
    }







}


?>