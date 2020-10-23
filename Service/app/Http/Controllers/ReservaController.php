<?php

namespace App\Http\Controllers;

use App\Providers\AutenticacaoService;
use App\Providers\ReservaService;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function getUserReservations(Request $request){

        $params = $request->input();

        if(!AutenticacaoService::verifyToken($params["userId"], $params["userToken"]))
            return json_encode(null); //se o token inserido não for o do usuário, retorna null

        
        $reservas = ReservaService::getReservasByUserId($params["userId"]);

        return json_encode($reservas);
    }
}
