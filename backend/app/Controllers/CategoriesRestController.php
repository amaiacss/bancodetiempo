<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use Config\Services;

class CategoriesRestController extends BaseController
{       
    public function findAll()
    {
        $model = new CategoryModel();
        $data = $model->findAll();
        $longitud = count($data);
        for($i=0; $i<$longitud; $i++) {
            $data[$i]->picture = Services::getCategoryImageURL() . $data[$i]->picture;
        }
        return $this->response->setStatusCode(200)->setJSON($data);
    }
    
    public function find($id)
    {
        $model = new CategoryModel();
        return $this->response->setStatusCode(200)->setJSON($model->find($id));
    }
}
