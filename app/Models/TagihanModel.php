<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table            = 'tagihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["siswa_id", "bulan", "tahun", "biaya", "status"];

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

    public function getWithSiswa()
    {
        $builder = $this->db->table('tagihan');
        $builder->select('tagihan.*, siswa.name as name, users.username',);
        $builder->join('siswa', 'siswa.id = tagihan.siswa_id');
        $builder->join('users', 'users.siswa_id = tagihan.siswa_id');
        return $builder->get()->getResultArray();
    }

    public function getWithSiswaForNotif()
    {
        $builder = $this->db->table('tagihan');
        $builder->select('tagihan.*, siswa.name as name, users.username',);
        $builder->join('siswa', 'siswa.id = tagihan.siswa_id');
        $builder->join('users', 'users.siswa_id = tagihan.siswa_id');
        $builder->where('tagihan.status', 'belum lunas');
        return $builder->get()->getResultArray();
    }

    public function getWithSiswaById($id)
    {
        $builder = $this->db->table('tagihan');
        $builder->select('tagihan.*, siswa.name as name');
        $builder->join('siswa', 'siswa.id = tagihan.siswa_id');
        $builder->where('tagihan.id', $id);
        return $builder->get()->getResultArray()[0];
    }
}
