<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["tagihan_id", "waktu", "foto", "status"];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getWithBill($status)
    {
        $builder = $this->db->table('pembayaran');
        $builder->select('pembayaran.*, tagihan.id as tagihan_id, tagihan.siswa_id, tagihan.bulan, tagihan.tahun, tagihan.biaya, siswa.name',);
        $builder->join('tagihan', 'tagihan.id = pembayaran.tagihan_id');
        $builder->join('siswa', 'tagihan.siswa_id = siswa.id');
        $builder->where('pembayaran.status', $status);
        return $builder->get()->getResultArray();
    }
}
