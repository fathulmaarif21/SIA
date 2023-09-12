<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->helper('print');
        date_default_timezone_set('Asia/Ujung_Pandang');
    }
    public function cetak()
    {

        $res = [
            "code" => "00",
            "msg" => "success"
        ];

        $data =  $this->input->post();
        if ($data) {
            if ($data == "" || $data == null) {
                $res = [
                    "code" => "99",
                    "msg" => "success"
                ];
                echo json_encode($res);
            } else {
                $user = ($this->session->userdata('nama')) ? $this->session->userdata('nama') : "Admin";
                // struk($data, $user);
                $respon = ['data' => $data, 'user' => $user];
                echo json_encode($respon);
                // echo json_encode($res);
            }
        }
    }
}
