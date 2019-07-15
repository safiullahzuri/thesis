<?php


class EncryptionController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function encrypt(){
       echo $this->encryption->encrypt("flowers.jpg");
    }

    function decrypt(){
        echo decrypt("b008a59021853d399a7d3b7f02d1e643cc276a08cf8bb8065833f2a9dd58aa15023ddd28808c6467077e2693920c442e8540c868efcc9a478c227b085ea812b79mOvfkdllMDiusgY5eaC2qCetT7yP+zqYhHU/dhYoXU=");
    }

    function hash(){
        echo md5("admin");
    }

}