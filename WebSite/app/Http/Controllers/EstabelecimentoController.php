<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Estabelecimento;
use App\Models\Quarto;
use App\Models\TipoDeEstabelecimento;
use App\Models\TipoDeQuarto;
use App\Providers\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EstabelecimentoController extends Controller
{
    public function buscarEstabelecimentos(Request $request){
        $params = $request->input();
        
        $response = Http::get("http://localhost:7000/api/buscarEstabelecimentosDisponiveis", $params);

        $response = $response->json();

        if($response["status"] == true){
            $estDisponiveis = [];

            foreach($response["estabelecimentos"] as $estD){

                $est = new Estabelecimento($estD["id"], $estD["nome"]);
                $endObj = (object) $estD["endereco"];
                $endereco = new Endereco($endObj->id, $endObj->rua, $endObj->numero,$endObj->bairro,$endObj->cidade,$endObj->estado);
                $est->setEndereco($endereco);
                $tipo = (object) $estD["tipo"];
                $est->setTipoDeEstabelecimento(new TipoDeEstabelecimento($tipo->id, $tipo->nome));
                $estDisponiveis[count($estDisponiveis)] = $est;
            }

            $dataEntrada = $params["dataEntrada"];
            $dataSaida = $params["dataSaida"];
            $cidade = $params["cidade"];

            return view("/paginas/estabelecimentosDisponiveis")
            ->with(compact('estDisponiveis'))
            ->with(compact("cidade"))
            ->with(compact('dataEntrada'))
            ->with(compact('dataSaida'));
        }
        return redirect("/");
    }

    public function acessarVisualizarQuartosDisponiveis(Request $request){
        $params = $request->input();
        
        $dataEntrada = $params["dataEntrada"];
        $dataSaida = $params["dataSaida"];

        $response = Http::get("http://localhost:7000/api/quartosDisponiveis",[
            "idEstabelecimento" => $params["idEstabelecimento"],
            "dataEntrada" => $dataEntrada,
            "dataSaida" => $dataSaida
        ]);

        $rep = $response->json();
        if($rep["status"] == true){
            $estObj = (object) $rep["obj"];
            $endObj = (object) $estObj->endereco;
            $tObj = (object) $estObj->tipo_de_estabelecimento;
            $quartos = $estObj->quartosDisponiveis;

            $estabelecimento = new Estabelecimento($estObj->id, $estObj->nome);
            $end = new Endereco($endObj->id, $endObj->rua, $endObj->numero, $endObj->bairro, $endObj->cidade, $endObj->estado);
            $tipo = new TipoDeEstabelecimento($tObj->id, $tObj->nome);
            $estabelecimento->setEndereco($end);
            $estabelecimento->setTipoDeEstabelecimento($tipo);

            $quartosVIP = [];
            $quartosNormais = [];
            
            foreach($quartos as $quarto){
                $quarto = (object) $quarto;
                $t = (object) $quarto->tipo_de_quarto;

                $q = new Quarto($quarto->id, $quarto->andar, $quarto->numero, $quarto->valor);         
                $tq = new TipoDeQuarto($t->id, $t->nome);
                $q->setTipoDeQuarto($tq);
                if($t->id == 1)
                    $quartosNormais[count($quartosNormais)] = $q;
                else if($t->id == 2)
                    $quartosVIP[count($quartosVIP)] = $q;
            }
            $estabelecimento->setQuartos(["normais" => $quartosNormais, "VIPs" => $quartosVIP]);

            $usuario = LoginService::getUsuarioLogado();

            return view("/paginas/quartos")
            ->with(compact('estabelecimento'))
            ->with(compact('dataEntrada'))
            ->with(compact('dataSaida'))
            ->with(compact('usuario'));
        }
        return redirect("/");
    }
}
