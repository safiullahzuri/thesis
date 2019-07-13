<?php


class DropzoneUploadController extends CI_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url','file'));
    }

    function index(){
        $this->load->view('upload_view');
    }

    // Upload in process

    function upload_files(){

        $config['upload_path']   = './uploads/scans/';
        $config['allowed_types'] = '*';
        $this->load->library('upload',$config);

        if($this->upload->do_upload('userfile'))
        {
            $token=$this->input->post('token');
            $file_name=$this->upload->data('file_name');
            $this->db->insert('scan',array('file_name'=>$file_name,'token'=>$token));
        }
    }


    // Delete Image

    function delete(){
        $token=$this->input->post('token');
        $query=$this->db->get_where('scan',array('token'=>$token));
        if($query->num_rows()>0){

            $data=$query->row();
            $file_name=$data->file_name;


            if(file_exists($file=FCPATH.'/uploads/scans/'.$file_name)){
                unlink($file);
            }
        }
        $this->db->delete('scan',array('token'=>$token));
        echo json_encode(array('deleted'=>true));

    }

}