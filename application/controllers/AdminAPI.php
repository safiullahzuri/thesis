<?php


class AdminAPI extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->init();
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
                //call the model method

                $imageName = $_FILES['image']['name'];

                $doctorData = array("username"=>$username, "firstname" => encrypt($firstname), "lastname" => encrypt($lastname),
                    "image" => encrypt($imageName)
                );

                if ($this->AdminModel->editAdmin($admin_id, $doctorData)){
                    echo "Edited successfully";
                }else{
                    echo "Could not edit";
                }
            }
        }else{
            //TODO: just update the record and do not change the previous path to image
            $doctorData = array("username"=>$username, "firstname" => encrypt($firstname), "lastname" => encrypt($lastname)
            );
            if ($this->AdminModel->editAdmin($admin_id, $doctorData)){
                echo "Edited successfully";
            }else{
                echo "Could not edit";
            }
        }
    }

    function delete(){
        $id = $this->input->post("id");
        if ($this->AdminModel->deleteAdmin($id)){
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

            $adminData = array("username"=>$username, "password" => md5($password), "firstname" => encrypt($firstname), "lastname" => encrypt($lastname),
                "image" => encrypt($imageName)
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



}