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
    protected $allowedFields    = ['name', 'description', 'active', 'department_id'];

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
        return $this->find($id);
    }

    public function getLocationByName($q)
    {
        return $this->select('*')
            ->orLike('name', $q)
            ->paginate(10, 'page');
    }
}
