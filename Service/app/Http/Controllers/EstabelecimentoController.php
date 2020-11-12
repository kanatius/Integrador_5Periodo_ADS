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

    public function getInfoEstabelecimento(Request $request){
        $params = $request->input();

        if(isset($params["idEstabelecimento"])){
            $vetorIds = [json_decode($params["idEstabelecimento"])];

            $estabelecimento = null;

            $est = $this->searchDataEstabelecimentos($vetorIds);

            //se recebeu algum objeto, adiciona
            if(count($est) > 0){
                $estabelecimento = $est[0];
            }
            
            return json_encode([
                "status" => true,
                "obj" => json_encode($estabelecimento)
            ]);
        }
        return json_encode([
            "status" => false,
            "mensagem" => "erro"
        ]);
    }


    public function getInfoEstabelecimentos(Request $request){
        $params = $request->input();

        if(isset($params["idsEstabelecimentos"])){
            $vetorIds = json_decode($params["idsEstabelecimentos"]);
            return json_encode([
                "status" => true,
                "obj" => json_encode($this->searchDataEstabelecimentos($vetorIds))
            ]);
        }
        return json_encode([
            "status" => false,
            "mensagem" => "erro"
        ]);
    }

    private function searchDataEstabelecimentos($vetorIds){
        return EstabelecimentoService::getEstabelecimentosByIds($vetorIds);
    }
}
