<?php

namespace App\Controllers;

use App\Models\ProvinceModel;

class ProvincesRestController extends BaseController
{       
    public function findAll()
    {
        $model = new ProvinceModel();
        return $this->response->setStatusCode(200)->setJSON($model->findAll());
    }
}
