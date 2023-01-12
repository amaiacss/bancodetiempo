<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use Config\Services;

class ProfilesRestController extends BaseController
{    
    public function create()
    {
        $profile = $this->request->getJSON();        
        $model = new ProfileModel();
        $data = $model->find($profile->id);
        if (!isSet($data)) {            
            if(!$model->insert($profile, true)) {
                $this->PrintResult();
                return $this->response->setStatusCode(400);
            } else {
                $this->SetResult('ok', true);                
            }
        }
        return $this->PrintResult();       
    }
    public function update()
    {
        $profile = $this->request->getJSON();
        $model = new ProfileModel();     
        $data = $model->find($profile->id);
        if (isSet($data)) {            
            if(!$model->update($profile->id, $profile)) {
                $this->PrintResult();
                return $this->response->setStatusCode(400);
            } else {
                $this->SetResult('ok', true);                
            }
        }
        return $this->PrintResult();
    }

    public function updatePicture()
    {
        $profile = $this->request->getJSON();
        $model = new ProfileModel();     
        $data = $model->find($profile->id);       
        $profile->picture = "profile" . $profile->id . ".jpg";  
        if (isSet($data)) {            
            if(!$model->update($profile->id, $profile)) {
                $this->PrintResult();
                return $this->response->setStatusCode(400);
            } else {
                $pictureData = base64_decode($profile->pictureData);                
                $filepath = "." . Services::getProfileImagePath() . $profile->picture;        
                file_put_contents($filepath, $pictureData);   
                $this->SetResult('picture', site_url(Services::getProfileImagePath() . $profile->picture));
                $this->SetResult('ok', true);                
            }
        }/*else{            
            if(!$model->insert($profile->id, $profile)) {
                $this->PrintResult();
                return $this->response->setStatusCode(400);
            } else {
                $this->SetResult('ok', true);                
            }
        }*/
        return $this->PrintResult();
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

        $model->select('profiles.id, profiles.firstName, profiles.lastName, profiles.phone, profiles.aboutMe, profiles.picture, profiles.credit, cities.code AS city_code, cities.name AS city, provinces.code AS province_code, provinces.name AS province, users.username');
        $model->where('profiles.id', $id);
        $model->join('cities', 'profiles.locationCode = cities.code');
        $model->join('provinces', 'provinces.code = cities.codeProvince');
        $model->join('users', 'users.id = profiles.id');
        
        $data = $model->findAll();
        foreach($data as $key => $val) {      
            if(isset($data[$key]->picture) && $data[$key]->picture!='') {
                $data[$key]->picture = site_url(Services::getProfileImagePath() . $data[$key]->picture);    
            }                   
        }       
        return $this->response->setStatusCode(200)->setJSON($data);
    }
}
