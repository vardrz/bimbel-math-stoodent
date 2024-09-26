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
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username wajib diisi',
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

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $admin = $this->userModel->where('username', $username)->first();

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                if($admin['role'] === "admin"){
                    session()->set([
                        'username' => $admin['username'],
                        'name' => $admin['name'],
                        'role' => $admin['role'],
                        'logged_in' => TRUE
                    ]);
                    return redirect()->to(base_url('home'));
                }else{
                    session()->set([
                        'username' => $admin['username'],
                        'name' => $admin['name'],
                        'role' => $admin['role'],
                        'siswa_id' => $admin['siswa_id'],
                        'logged_in' => TRUE
                    ]);
                    return redirect()->to(base_url('wali/home'));
                }
            } else {
                session()->setFlashdata('error', 'Password salah');
                return redirect()->to(base_url());
            }
        } else {
            session()->setFlashdata('error', 'Username tidak terdaftar');
            return redirect()->to(base_url());
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
}
