<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use Config\Services;

class CategoriesRestController extends BaseController
{       
    public function findAll()
    {
        $model = new CategoryModel();     
        $categories = $model->select('id, name_es, name_eu')->findall();
       /* $longitud = count($categories);
        for($i=0; $i<$longitud; $i++) {
            $data[$i]->picture = site_url(Services::getCategoryImagePath() . $data[$i]->picture);
        }*/
        return $this->response->setStatusCode(200)->setJSON($categories);
    }    
}
