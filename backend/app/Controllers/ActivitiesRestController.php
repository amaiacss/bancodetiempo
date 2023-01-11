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
        $model->select('activities.id, activities.title, activities.idUser, activities.created_at AS dateActivity, activities.description, categories.name_es AS category_es, categories.name_eu AS category_eu, categories.picture, profiles.firstName, profiles.lastName, profiles.phone, users.email, profiles.picture As profilePicture, cities.name AS city, provinces.name AS province');
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
            if(isset($data[$key]->profilePicture) && $data[$key]->profilePicture!='') {
                $data[$key]->profilePicture = site_url(Services::getProfileImagePath() . $data[$key]->profilePicture);
            }
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
}
