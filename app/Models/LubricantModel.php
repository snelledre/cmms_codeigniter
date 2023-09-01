<?php

namespace App\Models;

use App\Entities\Lubricant;
use CodeIgniter\Model;

class LubricantModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'lubricants';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Lubricant::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['supplier', 'name', 'status', 'description'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'supplier' => [
            'rules' => 'required|min_length[2]|max_length[64]',
            'label' => 'Leverancier'
        ],
        'name' => [
            'rules' => 'required|min_length[2]|max_length[64]|is_unique[lubricants.name,id,{id}]',
            'label' => 'Naam'
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

    public function getLubricantById($id)
    {
        return $this->find($id);
    }
}
