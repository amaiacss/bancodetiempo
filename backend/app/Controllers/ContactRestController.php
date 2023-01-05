<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ContactRestController extends BaseController
{
    public function index()
    {
        $contact = $this->requestdata;
        $correo = new \App\Libraries\Correo();
        return $correo->contacto($contact);
    }
}
