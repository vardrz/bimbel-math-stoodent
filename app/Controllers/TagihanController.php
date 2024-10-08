<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\TagihanModel;
use CodeIgniter\HTTP\ResponseInterface;

class TagihanController extends BaseController
{
    protected $tagihanModel;
    protected $siswaModel;

    public function __construct()
    {
        $this->tagihanModel = new TagihanModel();
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $data = $this->tagihanModel->getWithSiswa();

        return view('tagihan', [
            "data" => $data
        ]);
    }

    public function add()
    {
        $siswa = $this->siswaModel->findAll();
        $bulan = [
            ["value" => "01", "name" => "Januari"],
            ["value" => "02", "name" => "Februari"],
            ["value" => "03", "name" => "Maret"],
            ["value" => "04", "name" => "April"],
            ["value" => "05", "name" => "Mei"],
            ["value" => "06", "name" => "Juni"],
            ["value" => "07", "name" => "July"],
            ["value" => "08", "name" => "Agustus"],
            ["value" => "09", "name" => "September"],
            ["value" => "10", "name" => "Oktober"],
            ["value" => "11", "name" => "November"],
            ["value" => "12", "name" => "Desember"],
        ];

        $tahun = [
            ["value" => date('Y'), "name" => date('Y')],
            ["value" => date('Y')-1, "name" => date('Y')-1],
        ];

        return view('tagihan_add', [
            "siswa" => $siswa,
            "bulan" => $bulan,
            "tahun" => $tahun
        ]);
    }

    public function save(){
        $siswa_id = $this->request->getPost('siswa');
        $biaya = $this->request->getPost('biaya');
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');

        $cekDuplikatTagihan = $this->tagihanModel->where('siswa_id', $siswa_id)->where('bulan', $bulan)->where('tahun', $tahun)->first();

        if($cekDuplikatTagihan){
            session()->setFlashdata('error', "Tagihan siswa untuk periode tersebut sudah tersedia");
            return redirect()->to(base_url('tagihan/add'));
        }else{
            $this->tagihanModel->save([
                "siswa_id" => $siswa_id,
                "bulan" => $bulan,
                "tahun" => $tahun,
                "biaya" => $biaya,
                "status" => "belum lunas",
            ]);

            session()->setFlashdata('success', "Tagihan berhasil dibuat");
            return redirect()->to(base_url('tagihan'));
        }
    }

    public function edit($id)
    {
        $data = $this->tagihanModel->getWithSiswaById($id);

        return view('tagihan_edit', [
            "data" => $data
        ]);
    }

    public function update(){
        $id = $this->request->getPost('id');
        $biaya = $this->request->getPost('biaya');

        $this->tagihanModel->update($id, [
            "biaya" => $biaya,
        ]);

        session()->setFlashdata('success', "Tagihan berhasil diubah");
        return redirect()->to(base_url('tagihan'));
    }

    public function delete($id){
        $this->tagihanModel->delete($id);

        session()->setFlashdata('success', 'Tagihan berhasil dihapus.');
        return redirect()->to('/tagihan');
    }

    // Fungsi ini sudah tak ubah jadi send notif wa
    public function notif(){
        $template = $this->request->getPost('template');
        $subject = $this->request->getPost('subject');
        
        $whatsapp = $this->request->getPost('whatsapp');
        $text = $subject . "\r\n\r\n" . $template;
        
        $this->sendSingleNotif(
            $whatsapp,
            $text
        );

        session()->setFlashdata('success', 'Notifikasi tagihan berhasil dikirim ke nomor ' . $whatsapp);
        return redirect()->to('/tagihan');
    }

    private function sendSingleNotif($whatsapp, $text){
        $token = getenv("FONNTE_TOKEN");
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
            'target' => $whatsapp,
            'message' => $text,
            'countryCode' => '62',
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . $token
        ),
        ));

        curl_exec($curl);
        curl_close($curl);
	}

    public function notifBatch(){
        $template = "Tagihan Math Stodent Bulan {bulan} {tahun} \r\n\r\n" . $this->request->getPost('template');
        $tagihan = $this->tagihanModel->getWithSiswaForNotif();

        if(count($tagihan) == 0){
            session()->setFlashdata('error', 'Tidak ada email yang dikirim karena semua tagihan sudah lunas');
            return redirect()->to('/tagihan');
        }

        $data = [];
        foreach($tagihan as $t){
            array_push($data, [
                "target" => $t['username'],
                "message" => str_replace(
                    ["{siswa}", "{bulan}", "{tahun}", "{biaya}"],
                    [$t['name'], $t['bulan'], $t['tahun'], "Rp " . number_format($t['biaya']),],
                    $template
                ),
                "delay" => "2"
            ]);
        }

        $this->sendBatchNotif(json_encode($data));

        session()->setFlashdata('success', 'Notifikasi berhasil dikirim ke semua wali siswa.');
        return redirect()->to('/tagihan');
    }

    private function sendBatchNotif($data){
        $token = getenv("FONNTE_TOKEN");
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('data' => $data),
            CURLOPT_HTTPHEADER => array('Authorization: ' . $token),
        ));

        curl_exec($curl);
        curl_close($curl);
    }
}
