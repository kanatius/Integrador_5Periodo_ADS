<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Quarto;
use App\Models\QuartoDAO;
use App\Models\Reserva;
use App\Models\Estabelecimento;

class QuartoService extends ServiceProvider
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

    
    public static function getQuatoById($id){
        return QuartoDAO::findById($id);
    }

    public static function registerAllQuartos($quartos){
        return QuartoDAO::insertAll($quartos);
    }
    public static function getValorQuartoPousadaNormal(){
       return 150;
    }
    public static function getValorQuartoPousadaVIP(){
        return 250;
    }
    public static function getValorQuartoHotelNormal(){
        return 300;
    }
    public static function getValorQuartoHotelVIP(){
        return 500;
    }

    // public static function getQuartoByReserva(Reserva $reserva){
    //     $idQuarto = ReservaService::getIdQuarto($reserva);
    //     return QuartoDAO::findById($idQuarto);
    // }
    // public static function getQuartosByEstabelecimento(Estabelecimento $est){
    //     $quartos = QuartoDAO::getQuartosByIdEstabelecimento($est->getId());
    //     foreach($quartos as $quarto){
    //         $quarto = QuartoService::getDataQuarto($quarto);
    //     }
    //     return $quartos;
    // }
    // public static function getIdEstabelecimento(Quarto $quarto){
    //     return QuartoDAO::getIdEstabelecimento($quarto);
    // }
    // public static function getIdTipoDeQuarto(Quarto $quarto){
    //     return QuartoDAO::getIdTipoDeQuarto($quarto);
    // }
    // public static function getDataQuarto(Quarto $quarto){
    //     $tipo = TipoDeQuartoService::getTipoDeQuartoByQuarto($quarto);
    //     $quarto->setTipoDeQuarto($tipo);
    //     return $quarto;
    // }
}
