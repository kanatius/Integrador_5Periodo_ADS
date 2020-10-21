<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertReservas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $estabelcimentos = EstabelecimentoService::getAllEstabelecimentos();
        $quartos = QuartoService::getQuartosByEstabelecimento($estabelcimentos[0]);
        $usuario = new Usuario(200, "João Pedrosa", "JoaoPedrosa@gmail.com");
        UsuarioService::cadastrarUsuario($usuario);
        foreach ($quartos as $quarto) {      
            $reserva = new Reserva(0, '2020-08-20', '2020-08-29');
            $reserva->setSituacaoDoPagamento(SituacaoDePagamentoService::getSituacaoPagamentoAguardando());
            $reserva->setUsuario($usuario);
            $quarto->addReserva($reserva);
            ReservaService::registerReserva($reserva);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {    
        DB::table("reserva")->where("id", ">", 0)->delete();
        DB::table("usuario")->where("id", 200)->delete();
    }
}
