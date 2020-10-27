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

    // public static function getAllEstabelecimentos()
    // {
    //     $estabelecimentos = EstabelecimentoDAO::getAll();
    //     foreach ($estabelecimentos as $estabelecimento) {
    //         $tipo = TipoDeEstabelecimentoService::getTipoEstabelecimentoByEstabelecimento($estabelecimento);
    //         $endereco = EnderecoService::getEnderecoByEstabelecimento($estabelecimento);
    //         $estabelecimento->setTipoDeEstabelecimento($tipo);
    //         $estabelecimento->setEndereco($endereco);
    //     }
    //     return $estabelecimentos;
    // }
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
    public static function getEstabelecimentosByCidade($cidade)
    {
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
    // public static function getAllEstabelecimentosOrderedByNome()
    // {
    //     $estabelecimentos = EstabelecimentoDAO::getAllOrderedByNome();
    //     foreach ($estabelecimentos as $estabelecimento) {
    //         $tipo = TipoDeEstabelecimentoService::getTipoEstabelecimentoByEstabelecimento($estabelecimento);
    //         $endereco = EnderecoService::getEnderecoByEstabelecimento($estabelecimento);
    //         $estabelecimento->setTipoDeEstabelecimento($tipo);
    //         $estabelecimento->setEndereco($endereco);
    //     }
    //     return $estabelecimentos;
    // }
    // public static function getEstabelecimentoByQuarto(Quarto $quarto)
    // {
    //     $id_estabelecimento = QuartoService::getIdEstabelecimento($quarto);
    //     return EstabelecimentoDAO::findById($id_estabelecimento);
    // }

    // public static function getIdEndereco(Estabelecimento $estabelecimento)
    // {
    //     return EstabelecimentoDAO::getIdEndereco($estabelecimento);
    // }
    // public static function getIdTipoDeEstabelecimento(Estabelecimento $estabelecimento)
    // {
    //     return EstabelecimentoDAO::getIdTipoDeEstabelecimento($estabelecimento);
    // }


    // public static function registerEstabelecimento(Estabelecimento $estabelecimento)
    // {
    //     $id = EnderecoService::registerEndereco($estabelecimento->getEndereco());
    //     $estabelecimento->getEndereco()->setId($id);
    //     return EstabelecimentoDAO::insert($estabelecimento);
    // }
    // public static function registerAllEstabelecimentos($estabelecimentos)
    // {
    //     $results = [];
    //     foreach ($estabelecimentos as $estabelecimento) {
    //         $results[count($results)] = EstabelecimentoService::registerEstabelecimento($estabelecimento);
    //     }
    //     return $results;
    // }
    // public static function removeEstabelecimento(Estabelecimento $estabelecimento)
    // {
    //     EstabelecimentoDAO::remove($estabelecimento);
    //     return EnderecoService::removeEndereco($estabelecimento->getEndereco());
    // }
    // public static function removeAllEstabelecimentos(Estabelecimento $estabelecimentos)
    // {
    //     $results = [];
    //     foreach ($estabelecimentos as $estabelecimento) {
    //         $results[count($results)] = EstabelecimentoService::removeEstabelecimento($estabelecimento);
    //     }
    //     return $results;
    // }
}
