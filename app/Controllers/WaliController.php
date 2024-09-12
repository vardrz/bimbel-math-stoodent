<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\TagihanModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class WaliController extends BaseController
{
    protected $userModel;
    protected $tagihanModel;
    protected $siswaModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->tagihanModel = new TagihanModel();
        $this->siswaModel = new SiswaModel();
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

        return view('wali/bayar', [
            "data" => $tagihan,
            "siswa" => $siswa
        ]);
    }

    public function upload()
    {
        //
    }
}
