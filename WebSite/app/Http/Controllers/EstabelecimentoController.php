<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Estabelecimento;
use App\Models\TipoDeEstabelecimento;
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
}
