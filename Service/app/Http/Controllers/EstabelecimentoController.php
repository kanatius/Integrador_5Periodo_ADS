<?php

namespace App\Http\Controllers;

use App\Providers\EstabelecimentoService;
use App\Providers\ReservaService;
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
    public function getQuartosDisponiveis(Request $request){
        $params = $request->input();

        if(!(isset($params["idEstabelecimento"]) && isset($params["dataEntrada"]) && isset($params["dataSaida"])))
            return json_encode([
                "status" => false,
                "mensagem" => "Dados incompletos"
            ]);

        $datosEstabelecimetoMaisQuartosDisponiveis =  EstabelecimentoService::getQuartosDisponiveis($params["idEstabelecimento"], $params["dataEntrada"], $params["dataSaida"]);
        return json_encode([
            "status" => true,
            "obj" => $datosEstabelecimetoMaisQuartosDisponiveis
            ]);
    }
}
