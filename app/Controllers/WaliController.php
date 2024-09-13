<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\SiswaModel;
use App\Models\TagihanModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class WaliController extends BaseController
{
    protected $userModel;
    protected $tagihanModel;
    protected $siswaModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->tagihanModel = new TagihanModel();
        $this->siswaModel = new SiswaModel();
        $this->pembayaranModel = new PembayaranModel();
    }

    public function index()
    {
        $tagihan = $this->tagihanModel->where('siswa_id', session()->get('siswa_id'))->find();
        $siswa = $this->siswaModel->find(session()->get('siswa_id'));

        return view('wali/home', [
            "data" => $tagihan,
            "siswa" => $siswa
        ]);
    }

    public function bayar($id)
    {
        $tagihan = $this->tagihanModel->where('id', $id)->first();
        $siswa = $this->siswaModel->find(session()->get('siswa_id'));
        $pembayaran = $this->pembayaranModel->where('tagihan_id', $id)->find();

        return view('wali/bayar', [
            "data" => $tagihan,
            "siswa" => $siswa,
            "pembayaran" => $pembayaran
        ]);
    }

    public function upload()
    {
        if (!$this->validate([
            'bukti' => ['rules' => 'max_size[bukti,2024]']
        ])) {
            session()->setFlashdata('error', 'Ukuran file maksimal 2 mb');
            return redirect()->to(base_url('wali/bayar'));
        }

        $bukti = $this->request->getFile('bukti');
        $nameImage = $bukti->getRandomName();
        $bukti->move('bukti', $nameImage);

        $data = [
            'tagihan_id' => $this->request->getPost('id'),
            'waktu' => Time::now(),
            'foto' => $nameImage,
            'status' => "sedang dicek"
        ];

        $this->pembayaranModel->save($data);

        session()->setFlashdata('success', 'Pembayaran disimpan, status tagihan akan diupdate secara berkala.');
        return redirect()->to(base_url('wali/bayar/') . $this->request->getPost('id'));
    }
}
