<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class SiswaController extends BaseController
{
    protected $userModel;
    protected $siswaModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $data = $this->siswaModel->findAll();

        return view('siswa', [
            "data" => $data
        ]);
    }

    public function add()
    {
        return view('siswa_add');
    }

    public function save()
    {
        if (!$this->validate([
            'whatsapp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Whatsapp wajib diisi',
                ]
            ],
        ])) {
            session()->setFlashdata('validator', $this->validator->getErrors());
            return redirect()->to(base_url('siswa/add'));
        }

        $dataSiswa = [
            "name" => $this->request->getPost('name'),
            "wali" => $this->request->getPost('wali_name'),
            "whatsapp" => $this->request->getPost('whatsapp')
        ];

        $this->siswaModel->save($dataSiswa);

        $dataWali = [
            "name" => $this->request->getPost('wali_name'),
            "username" => $this->request->getPost('whatsapp'),
            "password" => password_hash('password123', PASSWORD_BCRYPT),
            "role" => "wali",
            "siswa_id" => $this->siswaModel->getInsertID()
        ];

        $this->userModel->save($dataWali);

        session()->setFlashdata('success', 'Data siswa berhasil disimpan.');
        return redirect()->to('/siswa');
    }

    public function edit($id)
    {
        $data = $this->siswaModel->find($id);

        return view('siswa_edit', [
            "data" => $data
        ]);
    }

    public function update()
    {
        if (!$this->validate([
            'whatsapp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Whatsapp wajib diisi',
                ]
            ],
        ])) {
            session()->setFlashdata('validator', $this->validator->getErrors());
            return redirect()->to(base_url('siswa/edit'));
        }

        $dataSiswa = [
            "name" => $this->request->getPost('name'),
            "wali" => $this->request->getPost('wali_name'),
            "whatsapp" => $this->request->getPost('whatsapp')
        ];

        $this->siswaModel->update($this->request->getPost('id'), $dataSiswa);

        $dataWali = [
            "name" => $this->request->getPost('wali_name'),
            "username" => $this->request->getPost('whatsapp'),
        ];

        $this->userModel->where('siswa_id', $this->request->getPost('id'))->set($dataWali)->update();

        session()->setFlashdata('success', 'Data siswa berhasil diubah.');
        return redirect()->to('/siswa');
    }

    public function delete($id){
        $this->siswaModel->delete($id);
        $this->userModel->where('siswa_id', $id)->delete();

        session()->setFlashdata('success', 'Data siswa berhasil dihapus.');
        return redirect()->to('/siswa');
    }
}
