<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }
    public function index()
    {
        $this->load->view('login/index');
    }
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data = $this->UserModel->getUser($username);
        if ($data) {
            $pass = $data->password;
            $verify_pass = password_verify($password, $pass);
            $verify_pass = true;
            if ($verify_pass) {
                $ses_data = [
                    'user_id' => $data->id,
                    'username' => $data->username,
                    'nama' => $data->nama,
                    'role_id' => $data->role_id,
                    'logged_in' => TRUE
                ];
                $this->session->set_userdata($ses_data);
                // $this->TriggerModel->createTiger();
                redirect('Dashboard');
            } else {
                $this->session->set_flashdata('msg', 'Password Salah!');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('msg', 'Username Tidak Ditemukan');
            redirect('login');
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
    public function user()
    {
        $this->load->view('user/index');
    }


    //--------------------------------------------------------------------

}
