<?php


function getAddressOfDoctor($scan_id){
    $scan = getAppointmentFromScan($scan_id);
    $appointment_id = $scan->appointment_id;
    $doctor_id = getDoctorIDFromAppointment($appointment_id);

    $CI = & get_instance();
    $CI->db->where('doctor_id', $doctor_id);
    $CI->db->from('doctor');

    $doctor = $CI->db->get()->row();

    $doctorImage = decrypt($doctor->image);

    $address = base_url().'uploads/avatars/'.$doctorImage;
    return $address;
}

function getDoctorNameFromScan($scan_id){
    $scan = getAppointmentFromScan($scan_id);
    $appointment_id = $scan->appointment_id;
    $doctor_id = getDoctorIDFromAppointment($appointment_id);

    $CI = & get_instance();
    $CI->db->where('doctor_id', $doctor_id);
    $CI->db->from('doctor');

    $doctor = $CI->db->get()->row();
    return getDoctor($doctor->doctor_id);
}

function getAppointmentFromScan($scan_id){
    $CI = & get_instance();
    $CI->db->where('scan_id', $scan_id);
    $CI->db->from('scan');
    return $CI->db->get()->row();
}

function getDoctorIDFromAppointment($appointment_id){
    $CI = & get_instance();
    $CI->db->where('app_id', $appointment_id);
    $CI->db->from('appointment');
    return $CI->db->get()->row()->doctor_id;
}

function gotAnyCommentsBefore($scan_id){
    $CI = & get_instance();
    $CI->db->where('scan_id', $scan_id);
    $CI->db->from('discussion');
    $query = $CI->db->get();
    if ($query->num_rows() > 0){
        return true;
    }else{
        return false;
    }
}

function getScanImage($scan_id){
    $CI = & get_instance();
    $CI->db->where('scan_id', $scan_id);
    $CI->db->from('scan');
    $scan = $CI->db->get()->row();
    $scanFile = decrypt($scan->file_name);
    $address = base_url('uploads/scans/').$scanFile;
    return $address;
}

function getDoctorImage($doctor_id){
    $CI = & get_instance();
    $CI->db->where('doctor_id', $doctor_id);
    $CI->db->from('doctor');
    $doctor = $CI->db->get()->row();
    $image = decrypt($doctor->image);
    $address = base_url('uploads/avatars/').$image;
    return $address;
}

