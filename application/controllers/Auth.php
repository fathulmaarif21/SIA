<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $user;
    public function __construct()
    {
        $this->user = new UserModel();
    }
    public function index()
    {
        helper(['form']);
        return view('auth/index');
    }
    public function login()
    {
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $this->user->where('username', $username)->first();
        if ($data) {
            $pass = $data->password;
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'user_id' => $data->id,
                    'username' => $data->username,
                    'nama' => $data->nama,
                    'role_id' => $data->role_id,
                    'foto' => $data->foto,
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/kasir');
            } else {
                $session->setFlashdata('msg', 'Password Salah!');
                return redirect()->to('/auth');
            }
        } else {
            $session->setFlashdata('msg', 'Username Tidak Ditemukan');
            return redirect()->to('/auth');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth');
    }
    public function user()
    {
        return view('user/index');
    }


    //--------------------------------------------------------------------

}
