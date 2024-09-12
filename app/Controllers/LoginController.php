<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('login');
    }

    public function login()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password wajib diisi'
                ]
            ]
        ])) {
            session()->setFlashdata('validator', $this->validator->getErrors());
            return redirect()->to(base_url());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $admin = $this->userModel->where('email', $email)->first();

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                if($admin['role'] === "admin"){
                    session()->set([
                        'email' => $admin['email'],
                        'name' => $admin['name'],
                        'logged_in' => TRUE
                    ]);
                    return redirect()->to(base_url('home'));
                }else{
                    dd("login sebagai orangtua siswa");
                }
            } else {
                session()->setFlashdata('error', 'Password salah');
                return redirect()->to(base_url());
            }
        } else {
            session()->setFlashdata('error', 'Email tidak terdaftar');
            return redirect()->to(base_url());
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
}
