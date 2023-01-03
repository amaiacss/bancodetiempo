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

    // cancelar la solicitud


}
