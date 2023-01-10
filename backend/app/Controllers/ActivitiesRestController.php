<?php

namespace App\Controllers;

use App\Models\ActivityModel;
use Config\Services;

class ActivitiesRestController extends BaseController
{       
    // para el buscador '¿QUE NECESITAS?'
    public function getActivities()
    {       
        $model = new ActivityModel();
        $model->select('activities.id, activities.title, activities.idUser, activities.created_at AS dateActivity, activities.description, categories.name_es AS category_es, categories.name_eu AS category_eu, categories.picture, profiles.firstName, profiles.lastName, profiles.phone, users.email, cities.name AS city, provinces.name AS province');
        $model->where('activities.deleted_at', NULL);
        $model->join('categories', 'activities.idCategory = categories.id');
        $model->join('profiles', 'activities.idUser = profiles.id');  // Un usuario que no tenga perfil no podrá publicar, por lo que este join no debe fallar
        $model->join('cities', 'profiles.locationCode = cities.code');
        $model->join('provinces', 'provinces.code = cities.codeProvince');
        $model->join('users', 'activities.idUser = users.id');
        // filtros
        if(isset($this->requestdata->category)) $model->where('activities.idCategory', $this->requestdata->category);
        if(isset($this->requestdata->province)) $model->where('provinces.code', $this->requestdata->province);
        if(isset($this->requestdata->city)) $model->where('cities.codeCity', $this->requestdata->city);
        if(isset($this->requestdata->search)) $model->like('activities.description', $this->requestdata->search);
        if(isset($this->requestdata->idUser)) $model->where('profiles.id', $this->requestdata->idUser);
        
        $model->orderBy('activities.updated_at', 'DESC');
        $data = $model->findAll();
        foreach($data as $key => $val) {      
            $data[$key]->picture = site_url(Services::getCategoryImagePath() . $data[$key]->picture);
            $data[$key]->url = site_url(route_to('card-activity', $data[$key]->id));
        }       
        $this->SetResult('ok', true);
        $this->SetResult('data', $data);
        return $this->PrintResult();
    }
    
    public function find($id)
    {
        $model = new ActivityModel();
        return $this->response->setStatusCode(200)->setJSON($model->find($id));
    }

    public function create()
    {
        $activity = $this->requestdata;        
        $model = new ActivityModel(); 
        
        if(!$model->insert($activity)) {
            $this->PrintResult();
            return $this->response->setStatusCode(400);
        } else {
            $this->SetResult('ok', true);
            return $this->PrintResult();
        }
    }

    public function lastActivities() {
    //     $model = new ActivityModel();
    //     $model->select('activities.title, activities.updated_at AS dateActivity, categories.name_es AS category_es, categories.name_eu AS category_eu, categories.picture, profiles.firstName AS nombrePropietario, profiles.lastName AS apellidoPropietario, cities.name AS city, provinces.name AS province');
    //     $model->join('requests', 'requests.idUser = ');
    //     $model->join('categories', 'activities.idCategory = categories.id');
    //     $model->join('profiles', 'activities.idUser = profiles.id', 'LEFT');  // este es el usuario que ha solicitado
    //    // $model->join('profiles', 'requests.idUser = profiles.id');
    //     $model->join('cities', 'profiles.locationCode = cities.code');
    //     $model->join('provinces', 'provinces.code = cities.codeProvince');
    //     $model->where('requests.idState', 'F');
    //     $data = $model->findAll();

        // Recupera el nombre y apellidos de la persona que solicitó la actividad
        // Falta el nombre y apellidos de la persona que publicó la actividad
        $model = new \App\Models\RequestsModel();
        $model->select('requests.created_at AS DateRequest, profiles.firstName, profiles.lastName, activities.id, activities.title, categories.name_es AS category_es, categories.name_eu AS category_eu');
        $model->where('requests.idState', 'F');
        $model->join('profiles', 'requests.idUser = profiles.id');
        $model->join('activities', 'activities.id = requests.idActivity');
        $model->join('categories', 'activities.idCategory = categories.id');
        $data = $model->findAll();

        $modelA = new ActivityModel();
        $modelA->select('profiles.firstName AS nameOwner, profiles.lastName AS lastNameOwner');
        $modelA->join('profiles', 'activities.idUser = profiles.id');
        $data1 = $modelA->findAll();
        $this->SetResult('ok', true);
        $this->SetResult('data', $data);
        $this->SetResult('data1', $data1);
        return $this->PrintResult();
    }
}
