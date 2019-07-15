<?php


class PatientsAPI extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->init();
    }

    function deletePatient()
    {
        $id = $this->input->post("id");
        if ($this->PatientModel->deletePatient($id)) {
            echo "Deleted successfully";
        } else {
            echo "Could not delete";
        }
    }

    function patient()
    {
        $id = $this->input->post("id");
        echo json_encode($this->PatientModel->getPatient($id));
    }

    function patients()
    {
        echo json_encode($this->PatientModel->getAllPatients());
    }

    function register()
    {
        $username = $this->input->post("username");
        $password = md5($this->input->post("password"));
        $firstname = encrypt($this->input->post("firstname"));
        $lastname = encrypt($this->input->post("lastname"));
        $job = $this->input->post("job");
        $dob = $this->input->post("dob");
        $city = $this->input->post("city");
        $street = $this->input->post("street");
        $email = $this->input->post("email");
        $postcode = encrypt($this->input->post("postCode"));
        $phoneNo = $this->input->post("phoneNo");
        $newImage = $this->input->post("newImage");
        $imageName = "avatar.png";

        if ($newImage == "true") {
            if (!$this->upload->do_upload("image")) {
                echo $this->upload->display_errors();

            }else{
                $imageData = $this->upload->data();
                //call the model method
                $imageName = $imageData["file_name"];
            }
        }


        $patientData = array("username" => $username, "password" => $password, "firstname" => encrypt($firstname), "lastname" => $lastname, "job" => $job, "dob" => $dob, "city" => $city, "street" => $street,
            "email" => $email, "postCode" => $postcode, "phoneNo" => $phoneNo, "image" => encrypt($imageName)
        );
        if ($this->PatientModel->addPatient($patientData)) {
            echo "patient successfully added";
        } else {
            echo "patient was not added";
        }


    }

    function init()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '2056';
        $config['max_height'] = '2056';
        $this->upload->initialize($config);
    }

    function edit()
    {
        $patient_id = $this->input->post("patient_id");
        $username = $this->input->post("username");
        $password = md5($this->input->post("password"));
        $firstname = encrypt($this->input->post("firstname"));
        $lastname = encrypt($this->input->post("lastname"));
        $job = $this->input->post("job");
        $dob = $this->input->post("dob");
        $city = $this->input->post("city");
        $street = $this->input->post("street");
        $email = $this->input->post("email");
        $postcode = encrypt($this->input->post("postCode"));
        $phoneNo = $this->input->post("phoneNo");

        $newImage = $this->input->post("newImage");

        if ($newImage == "true") {
            //TODO: upload new image and update the record
            if (!$this->upload->do_upload("image")) {
                echo $this->upload->display_errors();
            } else {
                $imageData = $this->upload->data();
                //call the model method

                $imageName = $_FILES['image']['name'];

                $patientData = array("username" => $username, "password" => $password, "firstname" => $firstname, "lastname" => $lastname, "job" => $job, "dob" => $dob, "city" => $city, "street" => $street,
                    "email" => $email, "postCode" => $postcode, "phoneNo" => $phoneNo, "image" => encrypt($imageName)
                );

                if ($this->PatientModel->editPatient($patient_id, $patientData)) {
                    echo "Edited successfully";
                } else {
                    echo "Could not edit";
                }

            }


        } else {
            //TODO: just update the record and do not change the previous path to image
            $newPatientData = array("username" => $username, "password" => $password, "firstname" => $firstname, "lastname" => $lastname, "job" => $job, "dob" => $dob, "city" => $city, "street" => $street,
                "email" => $email, "postCode" => $postcode, "phoneNo" => $phoneNo
            );
            if ($this->m->editPatient($patient_id, $newPatientData)) {
                echo "Edited successfully";
            } else {
                echo "Could not edit";
            }
        }


    }


}


?>