<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\usersModel;
use CodeIgniter\HTTP\Request;

class UsersController extends BaseController
{
    public function index() {
        $model = new usersModel();
        $users = $model->findAll();
        echo '<pre>'; print_r($users);
        exit();
    }

    public function store(Request $request) {
        //return usersModel::create($request->all);
    }
    
    public function show($id) {
        $model = new usersModel();
        $user = $model->find($id);
        print_r($user);
    }

    public function update(Request $request, $id) {
        $model = new usersModel();
        if($model->where('id', $id)->exists()) {
            $usuario = $model->find($id);
            $usuario->name = $request->name;
            $usuario->firstName = $request->firstName;
            $usuario->phone = $request->phone;
            $usuario->about_me = $request->about_me;

            $usuario->save();
            return response()->json([
                "message" => "Actualizado correctamente"
            ], 200);
        } else{
            return response()->json([
                "message" => "Usuario no existe"
            ], 404);
        }
    }

    public function destroy($id) {
        $model = new usersModel();
        if($model->where('id', $id)->exists()) {
            $usuario = $model->find($id);
            $usuario->delete();

            return response()->json([
                "message" => "Borrado correctamente"
            ], 200);
        }else{
            return response()->json([
                "message" => "Usuario no existe"
            ], 404);
        }
    }
}
