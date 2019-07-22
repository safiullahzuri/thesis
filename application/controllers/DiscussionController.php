<?php


class DiscussionController extends CI_Controller
{

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


    function allDiscussions(){

    }

    function openDiscussions(){
        $discussions = $this->DiscussionModel->getAllOpenDiscussions();

        $discussions = json_decode(json_encode($discussions));

        $data["discussions"] = $discussions;

        $this->load->view('discussion/open', $data);

    }

    function addCommentToDiscussion(){
        $comment_text = $this->input->post("comment_text");
        $scan_id = $this->input->post("scan_id");

        $comment = array("scan_id" => $scan_id, "comment_text" => $comment_text, "doctor_id" => $this->doctor_id);

        if ($this->DiscussionModel->addComment($comment)){
            $this->session->set_flashdata('comment_success', 'You have successfully added a comment to this discussion.');
            redirect('DiscussionController/createDiscussion/'.$scan_id);

        }else{
        }

    }

    function createDiscussion(){
        $scan_id = $this->uri->segment(3);

        $comments = $this->DiscussionModel->getAllCommentsFor($scan_id);

        $data["scan"] = $this->ScanModel->getScan($scan_id);
        $data["comments"] = $comments;
        $this->load->view("discussion/discussion", $data);
    }



}