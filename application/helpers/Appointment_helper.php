<?php


function getPatientsName($patientId){
    $CI = & get_instance();
    $CI->db->from("patient");
    $CI->db->where("patient_id", $patientId);
    $query = $CI->db->get()->row();
    $name = $query->firstname.' '.$query->lastname;
    return $name;
}

function getPatientsNameFromAppointment($appointment_id){
    $CI = & get_instance();
    $CI->db->select("patient_id");
    $CI->db->from("appointment");
    $CI->db->where("app_id", $appointment_id);
    $id = $CI->db->get()->row()->patient_id;
    return getPatientsName($id);
}



function getDoctorsName($doctorId){
    $CI = & get_instance();
    $CI->db->from("doctor");
    $CI->db->where("doctor_id", $doctorId);
    $query = $CI->db->get()->row();
    $name = $query->firstname.' '.$query->lastname;
    return $name;
}

function getDoctor($appointment_id){
    $CI = & get_instance();
    $CI->db->select("doctor_id");
    $CI->db->from("appointment");
    $CI->db->where("app_id", $appointment_id);
    $id = $CI->db->get()->row()->doctor_id;
    return getDoctorsName($id);
}