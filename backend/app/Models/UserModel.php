<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'email','username', 'pass', 'verified', 'activationCode', 'recuperationCode'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'email' => 'required|valid_email|is_unique[users.email]',
        'username' => 'required',
        'pass'  => 'required'
    ];
    protected $validationMessages   = [
        'email' => [
            'required'    => 'El email es obligatorio.',
            'valid_email' => 'Introduce un email con un formato válido.',
            'is_unique'   => 'Este email ya está registrado.'
        ],
        'pass' => [
            'required'  => 'Indica una contraseña.'
        ],
        'username' => [
            'required'  => 'El nombre de usuario es obligatorio',
           // 'is_unique'   => 'Este username ya está registrado.'
        ]
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
