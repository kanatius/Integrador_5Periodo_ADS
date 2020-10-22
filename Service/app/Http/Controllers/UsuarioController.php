<?php

namespace App\Http\Controllers;

use App\Providers\UsuarioService;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //


    public function getUsuario(Request $request){
        $params = $request->input();

        if(!(isset($params['email']) && isset($params['senha']))){
            return "Dados incompletos";
        }
        return UsuarioService::getByEmail($params['email']); 
    }
}
