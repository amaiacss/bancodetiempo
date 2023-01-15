<?php

namespace App\Controllers;

use App\Models\CityModel;

class CitiesRestController extends BaseController
{   
    public function findByProvince($id)
    {
        $model = new CityModel();
        return $this->response->setStatusCode(200)->setJSON($model->findByProvince($id));
    }
}
