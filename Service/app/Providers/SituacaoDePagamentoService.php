<?php

namespace App\Providers;

use App\Models\Reserva;
use App\Models\ReservaDAO;
use App\Models\SituacaoDePagamento;
use App\Models\SituacaoDePagamentoDAO;

use Illuminate\Support\ServiceProvider;

class SituacaoDePagamentoService extends ServiceProvider
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

    public static function getSituacaoByIdReserva($id){
        return SituacaoDePagamentoDAO::findById($id);
    }

    public static function getSituacaoPagamentoAguardando(){
        return new SituacaoDePagamento(1, "Aguardando");
    }

    public static function getSituacaoPagamentoPago(){
        return new SituacaoDePagamento(2, "Pago");
    }

    public static function getSituacaoPagamentoCancelado(){
        return new SituacaoDePagamento(3, "Cancelado");
    }
}
