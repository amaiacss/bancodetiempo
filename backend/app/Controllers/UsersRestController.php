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
    // Recibimos el nombre, email, y contraseña
    public function create()
    {
        $user = $this->request->getJSON();
        // comprobamos los datos recibidos a través del model
        $model = new usersModel();
        if(!$model->insert($user)) {
            return $this->fail($model->errors());
        }
        return $this->response->setStatusCode(200);
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
