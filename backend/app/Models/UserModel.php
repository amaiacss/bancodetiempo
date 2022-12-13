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
        //|regex_match[^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$]',
        //'name'  => 'required|regex_match[^[a-zA-Z ]{2,254}]'
    ];
    protected $validationMessages   = [
        'email' => [
            'required'    => 'El email es obligatorio.',
            'valid_email' => 'Introduce un email con un formato válido.',
            'is_unique'      => 'Este email ya está registrado.'
        ],
        'pass' => [
            'required'  => 'Indica una contraseña.',
           // 'regex_match' => 'La contraseña debe contener al menos 8 caracteres, una mayúscula, una minúscula y un número.'
        ],
        'username' => [
            'required'  => 'El nombre de usuario es obligatorio',
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
