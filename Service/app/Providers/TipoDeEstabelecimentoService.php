<?php

namespace App\Providers;

use App\Models\TipoDeEstabelecimento;
use App\Models\TipoDeEstabelecimentoDAO;
use App\Models\Estabelecimento;

use Illuminate\Support\ServiceProvider;

class TipoDeEstabelecimentoService extends ServiceProvider
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

    public static function getPousada(){
        return new TipoDeEstabelecimento(1, "Pousada");
    }
    public static function getHotel(){
        return new TipoDeEstabelecimento(2, "Hotel");
    }
    public static function getTipoEstabelecimentoByEstabelecimento(Estabelecimento $estabelecimento){
        $idTipo = EstabelecimentoService::getIdTipoDeEstabelecimento($estabelecimento);
        return TipoDeEstabelecimentoDAO::findById($idTipo);
    }
}
