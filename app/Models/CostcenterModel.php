<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Costcenter;

class CostcenterModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'costcenters';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Costcenter::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['code', 'description', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'code' => [
            'rules' => 'required|min_length[2]|max_length[64]|is_unique[costcenters.code,id,{id}]',
            'label' => 'Code'
        ],
        'description' => [
            'rules' => 'required|min_length[2]|max_length[64]',
            'label' => 'Omschrijving'
        ],
    ];
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

    public function getCostcenterById($id)
    {
        return $this->find($id);
    }
}
