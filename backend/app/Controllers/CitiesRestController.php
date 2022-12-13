<?php

namespace App\Controllers;

use App\Models\CityModel;

class CitiesRestController extends BaseController
{    
    public function create()
    {
        $city = $this->requestdata;
        
        $model = new CityModel();       
        
        if(!$model->insert($city, false)) {
            //return $this->response->setStatusCode(400);
            $data = ["message" => $model->errors()];
            return $this->setResponseFormat('json')->respond($data, 400);
        }
        return $this->setResponseFormat('json')->respond($city);
    }
        
    public function update()
    {
        $city = $this->request->getJSON();
        $model = new CityModel();
        if(!$model->update($city->code, $city)){
            $data = ["message" => $model->errors()];
            return $this->setResponseFormat('json')->respond($data, 400);
        }
        return $this->setResponseFormat('json')->respond($city);
    }
    
    public function delete($id)
    {        
        $model = new CityModel();
        if(!$model->delete($id)) {
            return $this->setResponseFormat('json')->respond($data, 400);
        }
        return $this->setResponseFormat('json')->respond(["message" => "City deleted"]);
    }
    public function findAll()
    {
        $model = new CityModel();
        return $this->response->setStatusCode(200)->setJSON($model->findAll());
    }
    
    public function find($id)
    {
        $model = new CityModel();
        return $this->response->setStatusCode(200)->setJSON($model->find($id));
    }

    public function findByProvince($id)
    {
        $model = new CityModel();
        return $this->response->setStatusCode(200)->setJSON($model->findByProvince($id));
    }
}
