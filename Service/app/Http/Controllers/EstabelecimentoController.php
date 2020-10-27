<?php

namespace App\Http\Controllers;

use App\Providers\EstabelecimentoService;
use DateTime;
use Illuminate\Http\Request;

class EstabelecimentoController extends Controller
{
    public function buscarEstabelecimentosDisponiveis(Request $request){
        $params = $request->input();

        if(!(isset($params["dataEntrada"]) && isset($params["dataSaida"]) && isset($params["cidade"])))
            return json_encode([
                "status" => false,
                "mensagem" => "Dados Incompletos!" 
            ]);

        $est = EstabelecimentoService::getEstabelecimentosDisponiveis($params["cidade"], $params["dataEntrada"], $params["dataSaida"]);
        return json_encode($est);
    }
}
