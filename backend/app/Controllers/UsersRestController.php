<?php

namespace App\Controllers;

use App\Models\usersModel;

class UsersRestController extends BaseController
{
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
        
        if(!$model->insert($user)) {
            return $this->fail($model->errors());
        }
        return $this->response->setStatusCode(200);
    }

    public function login() 
    {
        $login = $this->requestdata;   
        $result = ["id" => null];
        $model = new usersModel();
        // Consultamos email
        $res = $model->where('email', $login->email)->findAll();
        // si devuelve más de uno, error
        if(count($res)!=1) {
            return $result;
        }
        $row = $res[0];
        //print_r(($row));exit();
        if( md5($login->pass) == $row->pass ) {
            $result = [
                "id" => $row->id,
                "pass" => true,
                "username" => $row->firstName
            ];
        }
        return $this->setResponseFormat('json')->respond($result);
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
}
