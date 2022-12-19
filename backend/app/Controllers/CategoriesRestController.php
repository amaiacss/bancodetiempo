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
    
    public function find($id)
    {
        $model = new CategoryModel();
        return $this->response->setStatusCode(200)->setJSON($model->find($id));
    }

    public function create()
    {
        $category = $this->requestdata;        
        $model = new CategoryModel(); 
       // $base64 = explode(',', $category->picture);
       //$data = base64_decode($base64[1]);
        $data = base64_decode($category->pictureData);
        $filepath = "." . Services::getCategoryImagePath() . $category->picture; 
        file_put_contents($filepath, $data);
        
        if(!$model->insert($category)) {
            //return $this->response->setStatusCode(400);
            $data = ["message" => $model->errors()];
            return $this->setResponseFormat('json')->respond($data, 400);
        }
        //$category->id = $model->db->insert_id();
        return $this->setResponseFormat('json')->respond($category);
    }

   /* public function getListCategories() {
        $model = new CategoryModel();
        $categories = $model->select('id, name')->findall();
        
        if(count($categories) > 0) $this->SetResult('ok', true);
        $this->SetResult('categories', $categories);
        return $this->PrintResult();
    }*/
}
