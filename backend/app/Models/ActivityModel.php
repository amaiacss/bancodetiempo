<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'activities';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title', 'description', /*'picture',*/ 'idCategory', 'idUser', 'created_at', 'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [    
        'title'       => 'required|min_length[5]',
        'description' => 'required|min_length[25]',
        'idCategory'  => 'required'
    ];
    protected $validationMessages   = [
        'title'       => [ 'required'  => 'Título obligatorio.', 'min_length' => 'Título 5 caracteres mínimo.' ],
        'description' => [ 'required'  => 'Descripción obligatoria.', 'min_length' => 'Descripción 25 caracteres mínimo.' ],
        'idCategory'  => [ 'required'  => 'Categoría obligatoria.' ]
    ];
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
}
