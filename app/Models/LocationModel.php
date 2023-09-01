<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Location;

class LocationModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'locations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Location::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description', 'status', 'department_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => [
            'rules' => 'required|min_length[2]|max_length[64]|is_unique[locations.name,id,{id}]',
            'label' => 'Naam'
        ],
        'department_id' => [
            'rules' => 'required',
            'label' => 'afdeling'
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

    public function getLocationById($id)
    {
        return $this->select('locations.*, d.name as departmentname')
            ->join('departments d', 'd.id = locations.department_id', 'left')
            ->where('locations.id', $id)
            ->first();
    }

    public function getLocationsByName($q)
    {
        return $this->select('locations.*, d.name as departmentname')
            ->join('departments d', 'd.id = locations.department_id', 'left')
            ->orLike('locations.name', $q)
            ->paginate(10, 'page');
    }

    public function getLocations()
    {
        return $this->select('locations.*, d.name as departmentname')
            ->join('departments d', 'd.id = locations.department_id', 'left')
            ->paginate(10, 'page');
    }
}
