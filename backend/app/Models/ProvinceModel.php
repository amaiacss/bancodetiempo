<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'provinces';
    protected $primaryKey       = 'code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'code', 'name'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'code'  => 'required',
        'name'  => 'required'
        /*'email' => 'required|valid_email|is_unique[users.email]',
        'pass'  => 'required',
        //|regex_match[^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$]',
        //'name'  => 'required|regex_match[^[a-zA-Z ]{2,254}]'*/
    ];
    protected $validationMessages   = [
        'code' => [
            'required'    => 'El código es obligatorio.'
        ],
        'name' => [
            'required'    => 'El nombre es obligatorio.'
        ],
       /* 'email' => [
            'required'    => 'El email es obligatorio.',
            'valid_email' => 'Introduce un email con un formato válido.',
            'is_unique'      => 'Este email ya está registrado.'
        ],
        'pass' => [
            'required'  => 'Indica una contraseña.',
           // 'regex_match' => 'La contraseña debe contener al menos 8 caracteres, una mayúscula, una minúscula y un número.'
        ],
        /*'name' => [
            'required' => 'El nombre es obligatorio.',
            'regex_match' => 'El formato del nombre no es correcto.'
        ]*/
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
