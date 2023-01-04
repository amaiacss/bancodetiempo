<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RequestsModel;

class RequestsRestController extends BaseController
{
    public function create()
    {
        $request = $this->requestdata;  
        // TODO:Consultar si ésta petición ya existe 
        // TODO:Permitir registrar si para el mismo idUser, mismo idActivity, el idState == C || F 
        $model = new RequestsModel();
        
        if(!$model->insert($request)) {
            $this->PrintResult();
            return $this->response->setStatusCode(400);
        } else {
            $this->SetResult('ok', true);
            return $this->PrintResult();
        }
        return $this->PrintResult();   
    }

    // actualizar estado de la petición, recibe el id de la petición y el estado al que se quiere actualizar
    public function update() {
        $request = $this->requestdata;        
        $model = new RequestsModel();

        if(!$model->update($request->id, $request)) {
            $this->PrintResult();
            return $this->response->setStatusCode(400);
        } else {
            $this->SetResult('ok', true);
            return $this->PrintResult();
        }
        
    }
    // Se recuperan las solicitudes que se han hecho a otros usuario 
    // El id que se recibe es el logado
    public function getRequests($id) {
        $model = new RequestsModel();

        $model->select('requests.id, requests.updated_at, requeststates.name_es, requeststates.name_eu, activities.title');
        $model->where('requests.idUser', $id);
        $model->join('requeststates', 'requeststates.id = requests.idState');
        $model->join('activities', 'activities.id = requests.idActivity');
        $data = $model->findAll();
        if(count($data) > 0) {
            $this->SetResult('ok', true);
        }
        
        $this->SetResult('data', $data);
        return $this->PrintResult();
    }

    // Se recuperan las solicitudes que han hecho los usuarios a mis actividades
    // El id que se recibe es el logeado
    public function getRequestsByactivities($id) {
        $modelActivity = new \App\Models\ActivityModel();
        $modelActivity->select('id')->where('idUser', $id)->where('deleted_at', NULL);
        $activities = $modelActivity->findAll();
        $data = [];
        if (count($activities) > 0) {
            $activitiesid = [];
            foreach($activities as $key => $value) {
                array_push($activitiesid, $value->id);
            }
            $model = new RequestsModel();
            $model->select('requests.id, requests.updated_at, requeststates.name_es, requeststates.name_eu, activities.title, users.username');
            $model->join('requeststates', 'requeststates.id = requests.idState');
            $model->join('activities', 'activities.id = requests.idActivity');
            $model->join('users', 'users.id = requests.idUser');
            $data = $model->whereIn('idActivity', $activitiesid)->find();  
            $this->SetResult('ok', true);
        }

        $this->SetResult('data', $data);
        return $this->PrintResult();
    } 
}
