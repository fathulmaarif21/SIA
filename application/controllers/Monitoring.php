<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('session');
        // $this->load->model('UserModel');
        // $this->load->model('TriggerModel');
        // is_logged_in();
    }
    public function index()
    {
        // echo 'tes';

        $this->load->view('moni');
        // die;

    }

    public function des()
    {
        $this->session->sess_destroy();
    }

    public function getApi($id, $pd)
    {
        if ($this->session->userdata('token') == '') {
            $token = false;
        } else {
            $token = $this->session->userdata('token');
        }
        // $token = ($this->session->token('token')) ? $this->session->token('token') : false;

        // echo 'tes';
        if ($token) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.bi.go.id/bi/antasena/antasena/v1/validasi/status?idPelapor=" . $id . "&periodeData=" . $pd,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "authorization: Bearer  $token",
                    "x-bi-client-id: c1b435cf072e14f2c9ea4c766709c826"
                ),
            ));

            $response = json_decode(curl_exec($curl));
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo $err;
            } else {

                // echo $cekErr->httpCode;
                if (isset($response->httpCode)) {
                    if ($response->httpCode == '401') {
                        $token = $this->getToken();
                        $this->getApi($id, $pd);
                    } else {
                        echo json_encode($response);
                    }
                } else {
                    echo json_encode($response);
                }
            }
        } else {
            $token = $this->getToken();
            $this->getApi($id, $pd);
            // echo json_encode('invalid token');
        }
        // echo $token;


    }


    public function getToken()
    {
        $username = "rahmadsuryadi@banksultra.co.id";
        $password = "BankSultra135!";
        $authurl = "https://api.bi.go.id/bi/antasena/antasena/v1/oauth2/token";

        $client_id = "c1b435cf072e14f2c9ea4c766709c826";
        $client_secret = "0c8b66344493ba238591d092e058b9b5";


        $data = array(
            'grant_type' => 'password',
            'scope'      => 'antasena ',
            'username'   => $username,
            'password'   => $password,
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $authurl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $auth = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
            return false;
        }
        curl_close($ch);

        // return $auth;
        $secret = json_decode($auth);
        if ($secret->access_token) {
            $ses_data = [
                'token' => $secret->access_token
            ];
            $this->session->set_userdata($ses_data);
            return $secret->access_token;
        } else {
            return false;
        }
    }


    //--------------------------------------------------------------------

}
