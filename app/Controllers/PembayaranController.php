<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\SiswaModel;
use App\Models\TagihanModel;
use CodeIgniter\HTTP\ResponseInterface;

class PembayaranController extends BaseController
{
    protected $tagihanModel;
    protected $siswaModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->tagihanModel = new TagihanModel();
        $this->siswaModel = new SiswaModel();
        $this->pembayaranModel = new PembayaranModel();
    }

    public function index()
    {
        $status = $this->request->getGet('status') ?? "check";
        $statusFix = "";
        if($status == "check"){
            $statusFix = "sedang dicek";
        }elseif($status == "invalid"){
            $statusFix = "tidak valid";
        }else{
            $statusFix = $status;
        }

        $pembayaran = $this->pembayaranModel->getWithBill($statusFix);

        return view('pembayaran', [
            "data" => $pembayaran,
        ]);
    }

    public function accept($id, $tagihan_id){
        $this->pembayaranModel->update($id, [
            'status' => 'valid'
        ]);

        $this->tagihanModel->update($tagihan_id, [
            'status' => 'lunas'
        ]);

        session()->setFlashdata('success', 'Pembayaran diterima, tagihan lunas');
        return redirect()->to(base_url('pembayaran'));
    }

    public function reject($id){
        $this->pembayaranModel->update($id, [
            'status' => 'tidak valid'
        ]);

        session()->setFlashdata('success', 'Pembayaran ditolak');
        return redirect()->to(base_url('pembayaran'));
    }
}
