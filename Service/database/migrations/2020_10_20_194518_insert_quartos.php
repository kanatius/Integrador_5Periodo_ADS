<?php

use App\Models\Quarto;
use App\Providers\EstabelecimentoService;
use App\Providers\QuartoService;
use App\Providers\TipoDeQuartoService;
use App\Providers\TipoDeEstabelecimentoService;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertQuartos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $estabelecimentos = EstabelecimentoService::getAllEstabelecimentos();

        foreach($estabelecimentos as $estabelecimento){
            $quartos = [];
            //se for pousada
            if($estabelecimento->getTipoDeEstabelecimento()->getId() == TipoDeEstabelecimentoService::getPousada()->getId()){
                //Adicionando 5 quartos normais     
                for($i = 1; $i <= 5; $i++){
                    $quarto = new Quarto(0, rand(0,2), $i, QuartoService::getValorQuartoPousadaNormal());
                    $quarto->setEstabelecimento($estabelecimento);
                    $quarto->setTipoDeQuarto(TipoDeQuartoService::getNormal());
                    $quartos[count($quartos)] = $quarto;
                }
                //Adicionando 5 quartos VIPS
                for($i = 6; $i <= 10; $i++){
                    $quarto = new Quarto(0, rand(0,2), $i, QuartoService::getValorQuartoPousadaVIP());
                    $quarto->setEstabelecimento($estabelecimento);
                    $quarto->setTipoDeQuarto(TipoDeQuartoService::getVip());
                    $quartos[count($quartos)] = $quarto;
                }
            }
            //se for hotel
            if($estabelecimento->getTipoDeEstabelecimento()->getId() == TipoDeEstabelecimentoService::getHotel()->getId()){
                //Adicionando 5 quartos normais     
                for($i = 1; $i <= 5; $i++){
                    $quarto = new Quarto(0, rand(1,5), $i, QuartoService::getValorQuartoHotelNormal());
                    $quarto->setEstabelecimento($estabelecimento);
                    $quarto->setTipoDeQuarto(TipoDeQuartoService::getNormal());
                    $quartos[count($quartos)] = $quarto;
                }
                //Adicionando 5 quartos VIPS
                for($i = 6; $i <= 10; $i++){
                    $quarto = new Quarto(0, rand(5,20), $i, QuartoService::getValorQuartoHotelVIP());
                    $quarto->setEstabelecimento($estabelecimento);
                    $quarto->setTipoDeQuarto(TipoDeQuartoService::getVip());
                    $quartos[count($quartos)] = $quarto;
                }
            }
            QuartoService::registerAllQuartos($quartos);
        }    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("quarto")->where("id", ">", 0)->delete();
    }
}
