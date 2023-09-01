<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Machine;

class MachineModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'machines';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Machine::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description', 'image', 'status', 'location_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => [
            'rules' => 'required|min_length[2]|max_length[64]|is_unique[machines.name,id,{id}]',
            'label' => 'Naam'
        ],
        'location_id' => [
            'rules' => 'required',
            'label' => 'locatie'
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

    public function getMachineById($id)
    {
        return $this->select('machines.*, l.name as locationname')
            ->join('locations l', 'l.id = machines.location_id', 'left')
            ->where('machines.id', $id)
            ->first();
    }

    public function getMachines()
    {
        return $this->select('machines.*, l.name as locationname, d.name as departmentname')
            ->join('locations l', 'l.id = machines.location_id', 'left')
            ->join('departments d','d.id = l.department_id', 'left')
            ->findAll();
    }
}
