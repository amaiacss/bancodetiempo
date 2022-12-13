<?php

namespace App\Controllers;

use App\Models\ProvinceModel;

class ProvincesRestController extends BaseController
{    
    public function create()
    {
        $province = $this->requestdata;
        
        $model = new ProvinceModel();       
        
        if(!$model->insert($province, false)) {
            //return $this->response->setStatusCode(400);
            $data = ["message" => $model->errors()];
            return $this->setResponseFormat('json')->respond($data, 400);
        }

        return $this->setResponseFormat('json')->respond($province);
    }
        
    public function update()
    {
        $province = $this->request->getJSON();
        $model = new ProvinceModel();
        if(!$model->update($province->code, $province)){
            $data = ["message" => $model->errors()];
            return $this->setResponseFormat('json')->respond($data, 400);
        }
        return $this->setResponseFormat('json')->respond($province);
    }
    
    public function delete($id)
    {
        //$province = $this->request->getJSON();
        $model = new ProvinceModel();
        if(!$model->delete($id)) {
            return $this->setResponseFormat('json')->respond($data, 400);
        }
        return $this->setResponseFormat('json')->respond(["message" => "Province deleted"]);
    }
    public function findAll()
    {
        $model = new ProvinceModel();
        return $this->response->setStatusCode(200)->setJSON($model->findAll());
    }
    
    public function find($id)
    {
        $model = new ProvinceModel();
        return $this->response->setStatusCode(200)->setJSON($model->find($id));
    }
}
