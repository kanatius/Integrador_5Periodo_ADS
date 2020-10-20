<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class InsertSituacaoDePagamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $aguardando = SituacaoDePagamentoService::getSituacaoPagamentoAguardando();
        $pago = SituacaoDePagamentoService::getSituacaoPagamentoPago();
        $cancelado = SituacaoDePagamentoService::getSituacaoPagamentoCancelado();

        SituacaoDePagamentoDAO::insertAll([$aguardando, $pago, $cancelado]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("situacao_de_pagamento")->where("id", "<=", 3)->delete();
    }
}
