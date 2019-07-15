<?php

function encrypt($text){
    $CI = & get_instance();
    $cipherText = $CI->encryption->encrypt($text);
    return $cipherText;
}

function decrypt($cipherText){
    $CI = & get_instance();
    $text = $CI->encryption->decrypt($cipherText);
    return $text;
}
