<?php
namespace App\Libraries;

class Correo extends Core {
    public function __construct()
    {
        parent::__construct();
    }

    public function Registro($id_usuario)
    {
        $model = new \App\Models\UserModel();
        $result = $model->find($id_usuario);

        $datos = [];
        $datos['username'] = $result->username;
        $datos['email'] = $result->email;
        $datos['activacion_codigo'] = $result->activationCode;
        $datos['activacion_url'] = site_url(route_to('registro-activar', $datos['activacion_codigo']));
        $html = view('emails/confirmar_registro', $datos);

        return $this->EnviarEmail($from = '', $datos['email'], 'Banco de tiempo - Validar Cuenta', $plain_text = '', $html);
    }
}