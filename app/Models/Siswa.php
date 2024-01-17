<?php

namespace App\Models;

use CodeIgniter\Model;

class Siswa extends Model
{
    protected $table            = 'siswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_lembaga',
        'nis',
        'nama_siswa',
        'email',
        'foto',
    ];

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

    public function createSiswa($data) {
        $this->db->transBegin();

        $this->insert($data);

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }

    public function dataSiswa($where = null)
    {
        $this->select([
            'lembaga_siswa.nama_lembaga',
            'nis', 
            'nama_siswa',
            'email', 
            'foto',
        ]);

        if ($where !== null) {
            $this->where('nis',$where);
            $this->orWhere('lembaga_siswa.nama_lembaga',$where);
            $this->orWhere('nama_siswa',$where);
            $this->orWhere('email',$where);
            $this->orWhere('foto',$where);
        }
        $this->join('lembaga_siswa', 'siswa.id_lembaga = lembaga_siswa.id', 'left');

        return $this->get()->getResultArray();
    }

    public function getDataTabel($data) {
        
    }
}
