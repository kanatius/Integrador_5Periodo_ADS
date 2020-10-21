<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertEstabelecimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {   
        /*_______________ POUSADAS _______________*/

        //---------- ESTABELECIMENTO 1 ----------//

        $endereco1 = new Endereco(0, "R. Dix-Sept Rosado", 56, "Estação", "Alexandria", "Rio Grande do Norte");
        $estabelecimento1 = new Estabelecimento(0, "Pousada do Elísio");

        $estabelecimento1->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getPousada());
        $estabelecimento1->setEndereco($endereco1);

        //---------- ESTABELECIMENTO 1 ----------//
        
        //---------- ESTABELECIMENTO 2 ----------//
        $endereco2 = new Endereco(0, "R. Severino Rêgo", 0, "Alto do Açude", "Pau dos Ferros", "Rio Grande do Norte");
        $estabelecimento2 = new Estabelecimento(0, "Pousada Mão Preta");

        $estabelecimento2->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getPousada());
        $estabelecimento2->setEndereco($endereco2);
        //---------- ESTABELECIMENTO 2 ----------//


        //---------- ESTABELECIMENTO 3 ----------//
        $endereco3 = new Endereco(0, "Rua Correia Dias", 368, "Paraíso", "São Paulo", "São Paulo");
        $estabelecimento3 = new Estabelecimento(0, "Pousada Bonita");

        $estabelecimento3->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getPousada());
        $estabelecimento3->setEndereco($endereco3);
        //---------- ESTABELECIMENTO 3 ----------//


        //---------- ESTABELECIMENTO 4 ----------//
        $endereco4 = new Endereco(0, "R. Barão da Torre", 600, "Ipanema", "Rio de Janeiro", "Rio de Janeiro");
        $estabelecimento4 = new Estabelecimento(0, "Margarida's Pousada");

        $estabelecimento4->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getPousada());
        $estabelecimento4->setEndereco($endereco4);
        //---------- ESTABELECIMENTO 4 ----------//


        //---------- ESTABELECIMENTO 5 ----------//
        $endereco5 = new Endereco(0, "R. Afonso Célso", 119, "Barra", "Salvador", "Bahia");
        $estabelecimento5 = new Estabelecimento(0, "Estrela do Mar");

        $estabelecimento5->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getPousada());
        $estabelecimento5->setEndereco($endereco5);
        //---------- ESTABELECIMENTO 5 ----------//


        //---------- ESTABELECIMENTO 6 ----------//
        $endereco6= new Endereco(0, "R. Carapeba", 100, "Ponta Negra", "Natal", "Rio Grande do Norte");
        $estabelecimento6 = new Estabelecimento(0, "Natal Paradise");

        $estabelecimento6->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getPousada());
        $estabelecimento6->setEndereco($endereco6);
        //---------- ESTABELECIMENTO 6 ----------//


        //---------- ESTABELECIMENTO 7 ----------//
        $endereco7 = new Endereco(0, "R. Duque Estrada", 115, "Imbiribeira", "Recife", "Pernambuco");
        $estabelecimento7 = new Estabelecimento(0, "Pousada Sol e Mar");

        $estabelecimento7->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getPousada());
        $estabelecimento7->setEndereco($endereco7);
        //---------- ESTABELECIMENTO 7 ----------//


        //---------- ESTABELECIMENTO 8 ----------//
        $endereco8 = new Endereco(0, "R. Hermes de Castro Santos", 80, "Pres. Costa e Silva", "Mossoró", "Rio Grande do Norte");
        $estabelecimento8 = new Estabelecimento(0, "Ruta Del Sol");

        $estabelecimento8->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getPousada());
        $estabelecimento8->setEndereco($endereco8);
        //---------- ESTABELECIMENTO 8 ----------//


        //---------- ESTABELECIMENTO 9 ----------//
        $endereco9 = new Endereco(0, "R. São Francisco", 30, "Santana", "Porto Alegre", "Rio Grande do Sul");
        $estabelecimento9 = new Estabelecimento(0, "Pousada Terra Sul");

        $estabelecimento9->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getPousada());
        $estabelecimento9->setEndereco($endereco9);
        //---------- ESTABELECIMENTO 9 ----------//


        //---------- ESTABELECIMENTO 10 ----------//
        $endereco10 = new Endereco(0, "St. de Habitações Coletivas e Geminadas Norte", 712, "Asa Norte", "Brasília", "Distrito Federal");
        $estabelecimento10 = new Estabelecimento(0, "Pousada Damasco");

        $estabelecimento10->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getPousada());
        $estabelecimento10->setEndereco($endereco10);
        //---------- ESTABELECIMENTO 10 ----------//

        /*_______________ POUSADAS _______________*/


        /*________________ HOTEIS _______________*/
        
        //---------- ESTABELECIMENTO 11 ----------//
        $endereco11 = new Endereco(0, "R. Santo Antonio", 209, "Santo Antonio", "Alexandria", "Rio Grande do Norte");
        $estabelecimento11 = new Estabelecimento(0, "Hotel Alexandriense");

        $estabelecimento11->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getHotel());
        $estabelecimento11->setEndereco($endereco11);
        //---------- ESTABELECIMENTO 11 ----------//


        //---------- ESTABELECIMENTO 12 ----------//
        $endereco12 = new Endereco(0, "R. da Independência", 1705, "Centro", "Pau dos Ferros", "Rio Grande do Norte");
        $estabelecimento12 = new Estabelecimento(0, "Hertz Center Hotel");

        $estabelecimento12->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getHotel());
        $estabelecimento12->setEndereco($endereco12);
        //---------- ESTABELECIMENTO 12 ----------//


        //---------- ESTABELECIMENTO 13 ----------//
        $endereco13 = new Endereco(0, "R. Sampaio Viana", 425, "Paraíso", "São Paulo", "São Paulo");
        $estabelecimento13 = new Estabelecimento(0, "Transamerica Prime Paradise Garden");

        $estabelecimento13->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getHotel());
        $estabelecimento13->setEndereco($endereco13);
        //---------- ESTABELECIMENTO 13 ----------//


        //---------- ESTABELECIMENTO 14 ----------//
        $endereco14 = new Endereco(0, "R. Prof. Euríco Rabêlo", 16, "Maracanã", "Rio de Janeiro", "Rio de Janeiro");
        $estabelecimento14 = new Estabelecimento(0, "República Maracanã Hostel Vila Isabel");

        $estabelecimento14->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getHotel());
        $estabelecimento14->setEndereco($endereco14);
        //---------- ESTABELECIMENTO 14 ----------//


        //---------- ESTABELECIMENTO 15 ----------//
        $endereco15 = new Endereco(0, "Tv. Prudente de Morães", 65, "Rio Vermelho", "Salvador", "Bahia");
        $estabelecimento15 = new Estabelecimento(0, "The Hostel Salvador");

        $estabelecimento15->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getHotel());
        $estabelecimento15->setEndereco($endereco15);
        //---------- ESTABELECIMENTO 15 ----------//


        //---------- ESTABELECIMENTO 16 ----------//
        $endereco16 = new Endereco(0, "Av. Pres. Café Filho", 1176, "Praia dos Artistas", "Natal", "Rio Grande do Norte");
        $estabelecimento16 = new Estabelecimento(0, "Hotel Bruma");

        $estabelecimento16->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getHotel());
        $estabelecimento16->setEndereco($endereco16);
        //---------- ESTABELECIMENTO 16 ----------//


        //---------- ESTABELECIMENTO 17 ----------//
        $endereco17 = new Endereco(0, "R. Félix de Brito e Melo", 382, "Boa Viagem", "Recife", "Pernambuco");
        $estabelecimento17 = new Estabelecimento(0, "Hotel Aconchego Recife");

        $estabelecimento17->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getHotel());
        $estabelecimento17->setEndereco($endereco17);
        //---------- ESTABELECIMENTO 17 ----------//


        //---------- ESTABELECIMENTO 18 ----------//
        $endereco18 = new Endereco(0, "Av. Lauro Monte", 2001, "Santo Antônio", "Mossoró", "Rio Grande do Norte");
        $estabelecimento18 = new Estabelecimento(0, "Hotel Thermas");

        $estabelecimento18->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getHotel());
        $estabelecimento18->setEndereco($endereco18);
        //---------- ESTABELECIMENTO 18 ----------//


        //---------- ESTABELECIMENTO 19 ----------//
        $endereco19 = new Endereco(0, "Av. Osvaldo Aranha", 390, "Bom Fim", "Porto Alegre", "Rio Grande do Sul");
        $estabelecimento19 = new Estabelecimento(0, "Manhattan Apart-Hotel");

        $estabelecimento19->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getHotel());
        $estabelecimento19->setEndereco($endereco19);
        //---------- ESTABELECIMENTO 19 ----------//


        //---------- ESTABELECIMENTO 20 ----------//
        $endereco20 = new Endereco(0, "SHTN Trecho 01 Conjunto 01, Setor de Hotéis e Turismo Norte", 56, "Asa Norte", "Brasília", "Distrito Fereral");
        $estabelecimento20 = new Estabelecimento(0, "Brasília Palace Hotel");

        $estabelecimento20->setTipoDeEstabelecimento(TipoDeEstabelecimentoService::getHotel());
        $estabelecimento20->setEndereco($endereco20);
        //---------- ESTABELECIMENTO 20 ----------//

        /*________________ HOTEIS _______________*/
        
        $estabelecimentos = [
            $estabelecimento1,
            $estabelecimento2,
            $estabelecimento3,
            $estabelecimento4,
            $estabelecimento5,
            $estabelecimento6,
            $estabelecimento7,
            $estabelecimento8,
            $estabelecimento9,
            $estabelecimento10,
            $estabelecimento11,
            $estabelecimento12,
            $estabelecimento13,
            $estabelecimento14,
            $estabelecimento15,
            $estabelecimento16,
            $estabelecimento17,
            $estabelecimento18,
            $estabelecimento19,
            $estabelecimento20 
        ];

        EstabelecimentoService::registerAllEstabelecimentos($estabelecimentos);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("estabelecimento")->where("id", ">", 0)->delete();
        DB::table("endereco")->where("id", ">", 0)->delete();

        //Apaga todos os dados nas tabelas estabelecimento e endereco
    }
}
