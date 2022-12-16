<?php

namespace App\Controllers;

use App\Models\ProfileModel;

class ProfilesRestController extends BaseController
{    
    public function create()
    {
        $profile = $this->request->getJSON();        
        $model = new ProfileModel();
        $model->insert($profile, true);
        $this->setResponseFormat('json')->respond($profile);
    }
    public function update()
    {
        $profile = $this->request->getJSON();
        $model = new ProfileModel();
        $model->update($profile->id, $profile);
        return $this->response->setStatusCode(200);
    }
    
    public function delete($id)
    {
        $profile = $this->request->getJSON();
        $model = new ProfileModel();
        $model->delete($id);
        return $this->response->setStatusCode(200);
    }
    public function findAll()
    {
        $model = new ProfileModel();
        return $this->response->setStatusCode(200)->setJSON($model->findAll());
    }
    
    public function find($id)
    {
        $model = new ProfileModel();
        return $this->response->setStatusCode(200)->setJSON($model->find($id));
    }
}
