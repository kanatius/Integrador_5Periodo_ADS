<?php

namespace App\Http\Controllers;

use App\Providers\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReservaController extends Controller
{
    public function acessarMinhasReservas(){
        
        if(!LoginService::usuariosIsConnected()){
            return redirect("/");
        }

        $usuario = LoginService::getUsuarioLogadoWithToken();

        $response = Http::post("http://localhost:7000/api/reservas", [
            "userId" => $usuario->getId(),
            "userToken" => $usuario->getToken()
        ]);
        $reservas = $response->json();
        
        $usuario = LoginService::getUsuarioLogado();

        return view('/paginas/minhasReservas')
            ->with(compact('reservas'))
            ->with(compact('usuario'));
    }
}
