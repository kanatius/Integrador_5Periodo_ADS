<?php

namespace App\Http\Controllers;

use App\Providers\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReservaController extends Controller
{
    public function acessarMinhasReservas(Request $request){
        
        if(!LoginService::usuariosIsConnected()){
            return redirect("/");
        }

        $params = $request->input();
        
        $mensagem = null; 

        if(isset($params["mensagem"])){
            $mensagem = json_decode($params["mensagem"]);   
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
            ->with(compact('usuario'))
            ->with(compact('mensagem'));
    }

    public function reservarQuarto(Request $request){
        $params = $request->input();

        if(!(isset($params["idQuarto"]) && isset($params["dataEntrada"]) && isset($params["dataSaida"])))
            return redirect("/home");
        
        $usuario = LoginService::getUsuarioLogadoWithToken();

        $response = Http::get("http://localhost:7000/api/reservarQuarto", [
           "idQuarto" =>  $params["idQuarto"],
           "dataEntrada" => $params["dataEntrada"],
           "dataSaida" => $params["dataSaida"],
           "usuario" => ["id" => $usuario->getId(),
                         "token" => $usuario->getToken()
                        ]
        ]);
        $rep = $response->json();
        
        $mensagem = json_encode($rep);

        if($rep["status"] == true){  
            return redirect("/minhasReservas?mensagem=" . $mensagem);
        }
        return redirect("/home?mensagem=". $mensagem);
    }
}
