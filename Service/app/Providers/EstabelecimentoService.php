<?php

namespace App\Providers;

use App\Models\Estabelecimento;
use App\Models\EstabelecimentoDAO;
use App\Models\Quarto;
use DateTime;

use Illuminate\Support\ServiceProvider;

class EstabelecimentoService extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function getDataEstabelecimento($estabelecimento){
        $endereco = EnderecoService::getEnderecoById($estabelecimento->id_endereco);
        $estabelecimento->endereco = $endereco;
        $tipo = TipoDeEstabelecimentoService::getTipoDeEstabelecimentoById($estabelecimento->id_tipo_de_estabelecimento);
        $estabelecimento->tipo_de_estabelecimento = $tipo;
        return $estabelecimento;
    }


    public static function getEstabelecimentoById($id){
        $est = EstabelecimentoDAO::findById($id);
        EstabelecimentoService::getDataEstabelecimento($est);
        return $est;
    }

    #PEGA DADOS DE ESTABELECIMENTOS POR VETOR DE IDS
    public static function getEstabelecimentosByIds($ids){
        $resp = EstabelecimentoDAO::getEstabelecimentosByIds($ids);

        $estabelecimentos = [];

        foreach($resp as $row){
            $estabelecimentos[count($estabelecimentos)] = EstabelecimentoService::convertRowForSending($row);
        }

        return $estabelecimentos;
    }

    public static function getEstabelecimentosDisponiveis($cidade, $dataEntrada, $dataSaida){
        
        if(new DateTime($dataSaida) < new DateTime($dataEntrada)){
            //se a dataSaida é antes da data de entrada
                return [
                    "status" => false,
                    "mensagem" => "Erro: data de saída inserida é anterior a data de entrada" 
                ];
            }

        $estDisponiveis = [];

        $estabelecimentos = EstabelecimentoService::getEstabelecimentosByCidade($cidade);

        foreach($estabelecimentos as $estabelecimento){
            if(EstabelecimentoService::verifyDisponibilidadeEstabelecimento($estabelecimento->id, $dataEntrada, $dataSaida)){
                $estabelecimento->tipo = TipoDeEstabelecimentoService::getTipoDeEstabelecimentoById($estabelecimento->id_tipo_de_estabelecimento);
                unset($estabelecimento->id_tipo_de_estabelecimento);
                $estDisponiveis[count($estDisponiveis)] = $estabelecimento;            
            }   
        }
        return [
            "status" => true,
            "mensagem" => "Estabelecimentos disponíveis com check in em " . $dataEntrada . " e check out em " . $dataSaida,
            "estabelecimentos" =>  $estDisponiveis
        ];
    }
    public static function verifyDisponibilidadeEstabelecimento($id_estabelecimento, $dataEntrada, $dataSaida){
        $quartos = QuartoService::getQuartosByIdEstabelecimento($id_estabelecimento);
        foreach($quartos as $quarto){
            //se tiver algum quarto disponível, retorna true
            if(ReservaService::verifyDisponibilidade($quarto->id, $dataEntrada, $dataSaida))
            return true; //se tiver qualquer quarto disponível, retorna true
        }
        return false;
    }
    public static function getEstabelecimentosByCidade($cidade){
        $estabelecimentos = [];
        $enderecos = EnderecoService::getEnderecosByCidade($cidade); //pega os endereços cadastrados

        foreach ($enderecos as $endereco) {
            $estabelecimento = EstabelecimentoDAO::getByIdEndereco($endereco->id);
            $estabelecimento->endereco = $endereco;
            unset($estabelecimento->id_endereco);
            $estabelecimentos[count($estabelecimentos)] = $estabelecimento;
        }
        return $estabelecimentos;
    }

    public static function getQuartosDisponiveis($idEstabelecimento, $dataEntrada, $dataSaida){

        $quartosDisponiveis = [];

        $estabelecimento = EstabelecimentoService::getEstabelecimentoById($idEstabelecimento);
        EstabelecimentoService::getDataEstabelecimento($estabelecimento);

        unset($estabelecimento->id_endereco);
        unset($estabelecimento->id_tipo_de_estabelecimento);

        $quartos = QuartoService::getQuartosByIdEstabelecimento($idEstabelecimento);
        foreach($quartos as $quarto){
            if(ReservaService::verifyDisponibilidade($quarto->id, $dataEntrada, $dataSaida)){
                $quarto->tipo_de_quarto = TipoDeQuartoService::getTipoDeQuartoById($quarto->id_tipo_de_quarto);
                unset($quarto->id_tipo_de_quarto);
                $quartosDisponiveis[count($quartosDisponiveis)] = $quarto;
            }
        }
        $estabelecimento->quartosDisponiveis = $quartosDisponiveis;

        return $estabelecimento;
    }

    public static function convertRowForSending($row){

        $endereco = [
            "id" => $row->end_id,
            "rua" => $row->end_rua,
            "numero" => $row->end_numero,
            "bairro" => $row->end_bairro,
            "cidade" => $row->end_cidade,
            "estado" => $row->end_estado
        ];

        $tipo_de_estabelecimento = [
            "id" => $row->tipoDeEstabelecimento_id,
            "nome" => $row->tipoDeEstabelecimento_nome
        ];

        $estabelecimento = [
            "id" => $row->est_id,
            "nome" => $row->est_nome,
            "endereco" => $endereco,
            "tipo_de_estabelecimento" => $tipo_de_estabelecimento
        ];

        return $estabelecimento;
    }
}
