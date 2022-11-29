<?php

namespace App\Controllers;

use App\Models\usersModel;

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
        $model = new usersModel();
        $user->pass = md5($this->requestdata->pass);
        $user->activacion_codigo = date("YmdHis").rand(10000,99999);
        
        if(!$model->insert($user)) {
            return $this->response->setStatusCode(400);
           // return $this->fail($model->errors());
        }
        $id_usuario = $model->insertID;

        $correo = new \App\Libraries\Correo();
        $correo->Registro( $id_usuario );

        return $this->response->setStatusCode(200);
    }
    
    public function login() 
    {
        $login = $this->requestdata;   
        $result = ["id" => null];
        $model = new usersModel();
        // Consultamos email
        $res = $model->where('email', $login->email)->findAll();
        // si no devuelve uno, error
        if(count($res)!=1) {
            return $this->setResponseFormat('json')->respond($result);
        }
        $row = $res[0];
        if( md5($login->pass) == $row->pass ) {
            $result = [
                "id" => $row->id,
                "pass" => true,
                "username" => $row->username
            ];
        } else {
            $result = [
                "id" => $row->id,
                "pass" => false,
            ];
        }
        return $this->setResponseFormat('json')->respond($result);
    }

    public function Activar($cod)
    {
        $model = new \App\Models\usersModel();
        $model->where('activacion_codigo', $cod);
        $model->where('activo', 0);
        $res = $model->findAll();
        print_r($res);exit();
        if($res) return false;
        //if(!isset($res->id)) return false;
        $result = $model->ActivarCuenta($cod);
        if($result) {
            return redirect()->route('candidatos-perfil');
        }else{
            return redirect()->route('candidatos-registro');
        }
    }
    
    public function update()
    {
        $user = $this->request->getJSON();
        $model = new usersModel();
        $model->update($user->id, $user);
        return $this->response->setStatusCode(200);
    }
    
    public function delete($id)
    {
        $user = $this->request->getJSON();
        $model = new usersModel();
        $model->delete($id);
        return $this->response->setStatusCode(200);
    }
    public function findAll()
    {
        $model = new usersModel();
        return $this->response->setStatusCode(200)->setJSON($model->findAll());
    }
    
    public function find($id)
    {
        $model = new usersModel();
        return $this->response->setStatusCode(200)->setJSON($model->find($id));
    }
}
