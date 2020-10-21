<?php

namespace App\Providers;

use App\Models\Estabelecimento;
use App\Models\EstabelecimentoDAO;
use App\Models\Quarto;

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

    public static function getDataEstabelecimento(Estabelecimento $estabelecimento){
        $endereco = EnderecoService::getEnderecoByEstabelecimento($estabelecimento);
        $estabelecimento->setEndereco($endereco);
        $tipo = TipoDeEstabelecimentoService::getTipoEstabelecimentoByEstabelecimento($estabelecimento);
        $estabelecimento->setTipoDeEstabelecimento($tipo);
        return $estabelecimento;
    }

    public static function getAllEstabelecimentos()
    {
        $estabelecimentos = EstabelecimentoDAO::getAll();
        foreach ($estabelecimentos as $estabelecimento) {
            $tipo = TipoDeEstabelecimentoService::getTipoEstabelecimentoByEstabelecimento($estabelecimento);
            $endereco = EnderecoService::getEnderecoByEstabelecimento($estabelecimento);
            $estabelecimento->setTipoDeEstabelecimento($tipo);
            $estabelecimento->setEndereco($endereco);
        }
        return $estabelecimentos;
    }
    public static function getEstabelecimentosDisponiveis($cidade, $dataEntrada, $dataSaida){
        $estDisponiveis = [];

        $estabelecimentos = EstabelecimentoService::getEstabelecimentoByCidade($cidade);
        foreach($estabelecimentos as $estabelecimento){
            if(EstabelecimentoService::verifyDisponibilidadeEstabelecimento($estabelecimento, $dataEntrada, $dataSaida)){
                EstabelecimentoService::getDataEstabelecimento($estabelecimento);
                $estDisponiveis[count($estDisponiveis)] = $estabelecimento;            
            }   
        }
        return $estDisponiveis;
    }
    public static function verifyDisponibilidadeEstabelecimento(Estabelecimento $estabelecimento, $dataEntrada, $dataSaida){
        $quartos = QuartoService::getQuartosByEstabelecimento($estabelecimento);
        foreach($quartos as $quarto){
            //se tiver algum quarto disponível, retorna true
            if(ReservaService::verifyDisponibilidade($quarto, $dataEntrada, $dataSaida))
            return true;
        }
        return false;
    }
    public static function getEstabelecimentoByCidade($cidade)
    {
        $estabelecimentos = [];
        $enderecos = EnderecoService::getEnderecoByCidade($cidade);
        foreach ($enderecos as $endereco) {
            $estabelecimento = EstabelecimentoDAO::getByIdEndereco($endereco->getId());
            $estabelecimento->setEndereco($endereco);
            $estabelecimentos[count($estabelecimentos)] = $estabelecimento;
        }
        return $estabelecimentos;
    }
    public static function getAllEstabelecimentosOrderedByNome()
    {
        $estabelecimentos = EstabelecimentoDAO::getAllOrderedByNome();
        foreach ($estabelecimentos as $estabelecimento) {
            $tipo = TipoDeEstabelecimentoService::getTipoEstabelecimentoByEstabelecimento($estabelecimento);
            $endereco = EnderecoService::getEnderecoByEstabelecimento($estabelecimento);
            $estabelecimento->setTipoDeEstabelecimento($tipo);
            $estabelecimento->setEndereco($endereco);
        }
        return $estabelecimentos;
    }
    public static function getEstabelecimentoByQuarto(Quarto $quarto)
    {
        $id_estabelecimento = QuartoService::getIdEstabelecimento($quarto);
        return EstabelecimentoDAO::findById($id_estabelecimento);
    }
    public static function getEstabelecimentosById($id){
        $est = EstabelecimentoDAO::findById($id);
        EstabelecimentoService::getDataEstabelecimento($est);
        return $est;
    }
    public static function getIdEndereco(Estabelecimento $estabelecimento)
    {
        return EstabelecimentoDAO::getIdEndereco($estabelecimento);
    }
    public static function getIdTipoDeEstabelecimento(Estabelecimento $estabelecimento)
    {
        return EstabelecimentoDAO::getIdTipoDeEstabelecimento($estabelecimento);
    }


    public static function registerEstabelecimento(Estabelecimento $estabelecimento)
    {
        $id = EnderecoService::registerEndereco($estabelecimento->getEndereco());
        $estabelecimento->getEndereco()->setId($id);
        return EstabelecimentoDAO::insert($estabelecimento);
    }
    public static function registerAllEstabelecimentos($estabelecimentos)
    {
        $results = [];
        foreach ($estabelecimentos as $estabelecimento) {
            $results[count($results)] = EstabelecimentoService::registerEstabelecimento($estabelecimento);
        }
        return $results;
    }
    public static function removeEstabelecimento(Estabelecimento $estabelecimento)
    {
        EstabelecimentoDAO::remove($estabelecimento);
        return EnderecoService::removeEndereco($estabelecimento->getEndereco());
    }
    public static function removeAllEstabelecimentos(Estabelecimento $estabelecimentos)
    {
        $results = [];
        foreach ($estabelecimentos as $estabelecimento) {
            $results[count($results)] = EstabelecimentoService::removeEstabelecimento($estabelecimento);
        }
        return $results;
    }
}
