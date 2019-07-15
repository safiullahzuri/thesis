<?php


class UploadScanController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->init();
    }

    function init(){

        $config['upload_path'] = './uploads/scans/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;

        $this->upload->initialize($config);
    }

    function uploadScans(){
        $viewData = array();
        if ($this->input->post("submit") && count($_FILES["multipleFiles"]["name"])){

            $descriptions = $this->input->post("description");

            $appointment_id = $this->input->post("appointment_id");

            $viewData["appointment_id"] = $appointment_id;

            $number_of_files = count($_FILES["multipleFiles"]["name"]);

            $files = $_FILES;

            if (!is_dir('uploads/scans')){
                mkdir('./uploads/scans', 0777, true);
            }

            for ($i = 0; $i< $number_of_files; $i++){

                $_FILES['multipleFiles']['name'] = $files['multipleFiles']['name'][$i];
                $_FILES['multipleFiles']['type'] = $files['multipleFiles']['type'][$i];
                $_FILES['multipleFiles']['tmp_name'] = $files['multipleFiles']['tmp_name'][$i];
                $_FILES['multipleFiles']['error'] = $files['multipleFiles']['error'][$i];
                $_FILES['multipleFiles']['size'] = $files['multipleFiles']['size'][$i];
                $scan_desc = $descriptions[$i];
                if (!$this->upload->do_upload('multipleFiles')){
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                }else{
                    $data =$this->upload->data();
                    $this->ScanModel->addScan(encrypt($data["file_name"]), $scan_desc, $appointment_id );
                    $this->session->set_flashdata("upload_success", "You successfully uploaded all your files!");
                }
            }
        }

        $this->load->view("Diagnosis/add", $viewData);
    }

}