<?php

namespace App\Controllers;

use App\Models\UserModel;
use Config\Services;

class UsersRestController extends BaseController
{    
    // Registro de nuevo Usuario
    // Recibimos el email, y contraseña
    // encripta la contraseña
    //mediante el model comprubea que le email sea único
    public function create()
    {
        $user = $this->requestdata;
        // comprobamos los datos recibidos a través del model
        $model = new UserModel();
        $user->pass = md5($this->requestdata->pass);
        $user->activationCode = date("YmdHis").rand(10000,99999);
        
        if(!$model->insert($user)) {
            // En el caso de que se quiera gestionar los errores del formulario create
            // $error = $model->errors();
            // if( isset($error) && count($error) > 0 ) {
            //     foreach($error as $err => $valor) {
            //         $this->SetResult($err, $valor);
            //     }
            // }
            $this->PrintResult();
            return $this->response->setStatusCode(400);
        } else {
            $id_usuario = $model->insertID;
    
            $correo = new \App\Libraries\Correo();
            $correo->Registro( $id_usuario );
    
            $this->SetResult('ok', true);
            return $this->PrintResult();
        }
    }
    
    public function login() 
    {
        $login = $this->requestdata;   
        $result = ["id" => null];
        $model = new UserModel();
        // Consultamos email
        $res = $model->where('email', $login->email)->findAll();
        // si no devuelve uno, error
        if(count($res)!=1) {
            return $this->setResponseFormat('json')->respond($result);
        }
        $row = $res[0];
        if($row->verified == 0) {
            $result = ["verified" => $row->verified];
            return $this->setResponseFormat('json')->respond($result);
        }
        
        if( md5($login->pass) == $row->pass ) {
            $result = [
                "id" => $row->id,
                "pass" => true,
                "verified" => $row->verified
            ];
        } else {
            $result = [
                "id" => $row->id,
                "pass" => false,
            ];
        }
        return $this->setResponseFormat('json')->respond($result);
    }

    public function activar($cod)
    {
        $urlerror = Services::getFrontURL() . "/login?verified=error";        
        $model = new \App\Models\UserModel();
        $model->where('activationCode', $cod);
        $res = $model->findAll();
        
        if(count($res) == 0) { header("Location: $urlerror"); exit(); }
        if(!isset($res[0]->id)) { header("Location: $urlerror"); exit(); }
        if($res[0]->verified == 1) { header("Location: " . Services::getFrontURL() . "/login?verified=error44"); exit(); }
        
        $id = $res[0]->id;

        $updatedata = ['verified' => 1];
        if($model->update($id, $updatedata)) {
            header("Location: " . Services::getFrontURL() . "/login?verified=ok");
        } else {
            header("Location: $urlerror");
        }
        exit();
    }

    public function updatePass() {
        $model = new UserModel();
        $error_clave = false;
        $idUser = $this->requestdata->id;
        $userPass = $model->select("pass")->find($idUser);
        if($userPass->pass == md5( $this->requestdata->pass )) {
            if( isset($this->requestdata->pass1) && isset($this->requestdata->pass2) ) {
                $pass1 = str_replace(" ", "", $this->requestdata->pass1);
                $pass2 = str_replace(" ", "", $this->requestdata->pass2);
                if($pass1 == $pass2) {
                    $model->update($idUser, ["pass" => md5( $pass1 )]);
                    $this->setResult("ok", true);
                }
            } 
        }  
        return $this->PrintResult();
    }

    public function find($id)
    {
        $model = new UserModel();
        return $this->response->setStatusCode(200)->setJSON($model->find($id));
    }
}
