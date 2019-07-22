<?php

    class AnnotationController extends CI_Controller{

        private $doctor_id;

        function __construct()
        {
            parent::__construct();
            if ($this->session->has_userdata("id") && $this->session->userdata("userType") == 'doctor'){
                $this->doctor_id = $this->session->userdata("id");
            }else{
                redirect("LoginController/login");
            }
            $this->load->view("links");
            $this->load->view("doctor/navigation");
        }

        function index(){

        }

        function annotation(){
            $scan_id = $this->uri->segment(3);
            $annotations = $this->AnnotationModel->getAllAnnotationsFor($scan_id);

            $data["scan"] = $this->ScanModel->getScan($scan_id);
            $data["annotations"] = $annotations;
            $this->load->view("annotation/annotation", $data);
        }


        function addAnnotation(){
            $annotation_text = $this->input->post("annotation_text");
            $scan_id = $this->input->post("scan_id");

            $annotation = array("scan_id" => $scan_id, "annotation_text" => $annotation_text);

            if ($this->AnnotationModel->addAnnotation($annotation)){
                $this->session->set_flashdata('ann_success', 'You have successfully added an annotation.');
                redirect('AnnotationController/annotation/'.$scan_id);

            }else{
            }


        }


    }


?>