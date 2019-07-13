<?php


class DoctorsAPI extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->init();
    }

    function init(){
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '2056';
        $config['max_height'] = '2056';
        $this->upload->initialize($config);
    }

    function doctors(){
        $doctors = $this->DoctorModel->getAllDoctors();
        echo json_encode($doctors);
    }

    function edit(){
        $doctor_id = $this->input->post("doctor_id");
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $firstname = $this->input->post("firstname");
        $lastname = $this->input->post("lastname");
        $dob = $this->input->post("dob");
        $city = $this->input->post("city");
        $street = $this->input->post("street");
        $email = $this->input->post("email");
        $postcode = $this->input->post("postCode");
        $phoneNo = $this->input->post("phoneNo");

        $newImage = $this->input->post("newImage");

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
        if ($this->m->deleteDoctor($id)){
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

    function register(){
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $firstname = $this->input->post("firstname");
        $lastname = $this->input->post("lastname");
        $dob = $this->input->post("dob");
        $city = $this->input->post("city");
        $street = $this->input->post("street");
        $email = $this->input->post("email");
        $postcode = $this->input->post("postCode");
        $phoneNo = $this->input->post("phoneNo");

        if (!$this->upload->do_upload("image")) {
            echo $this->upload->display_errors();
        } else {
            $imageData = $this->upload->data();
            //call the model method

            $imageName = $imageData["file_name"];

            $doctorData = array("username"=>$username, "password" => $password, "firstname" => $firstname, "lastname" => $lastname, "dob" => $dob, "city" => $city, "street" => $street,
                "email" => $email, "postCode" => $postcode, "phoneNo" => $phoneNo, "image" => $imageName
            );

            if ($this->DoctorModel->addDoctor($doctorData)) {
                echo "Doctor successfully added";
            } else {
                echo "Doctor was not added";
            }


        }
    }


}