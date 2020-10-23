<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ReservaDAO extends Model
{
    //-------------- GET --------------//
    public static function findById($id){
        return DB::table("reserva")->where("id", $id)->first();
    }

    public static function getAll(){
        return DB::table("reserva")->get();
    }
    // get by id foreign key
    public static function getReservasByIdUsuario($id){
        return DB::table("reserva")->where("id_usuario", $id)->orderBy("data_saida", "desc")->get();
    }
    public static function getReservasByIdQuarto($id){
        return DB::table("reserva")->where("id_quarto", $id)->get();
    }
    public static function getReservasByIdSituacaoDePagamento($id){
        return DB::table("reserva")->where("id_situacao_de_pagamento", $id)->get();
    }
    public static function getReservaByDates($id_quarto, $dataEntrada, $dataSaida){
        return DB::table("reserva")->whereRaw(
            "id_quarto = (?) and ( 
                (data_entrada >= (?) and data_entrada <= (?) )  
                or 
                (data_saida >= (?) and data_saida <= (?) )
            )",
            [$id_quarto, $dataEntrada, $dataSaida, $dataEntrada, $dataSaida]
        )->first();
    }
    // get by id foreign key

    // get id foreign key
    public static function getIdUsuario(Reserva $reserva){
        $row = DB::table("reserva")->select("id_usuario")->where("id", $reserva->getId())->first();
        return $row->id_usuario;
    }
    public static function getIdQuarto(Reserva $reserva){
        $row = DB::table("reserva")->select("id_quarto")->where("id", $reserva->getId())->first();
        return $row->id_quarto;
    }
    public static function getIdSituacaoDePagamento(Reserva $reserva){
        $row = DB::table("reserva")->select("id_situacao_de_pagamento")->where("id", $reserva->getId())->first();
        return $row->id_situacao_de_pagamento;
    }
    // get id foreign key
    //-------------- GET --------------//

    //-------------- INSERT --------------//
    public static function insert(Reserva $reserva){
        $dados = [
            "data_entrada" => $reserva->getDataEntrada(),
            "data_saida" => $reserva->getDataSaida(),
            "valor_a_pagar" => $reserva->getValorAPagar(),
            "id_quarto" => $reserva->getQuarto()->getId(),
            "id_usuario" => $reserva->getUsuario()->getId(),
            "id_situacao_de_pagamento" => $reserva->getSituacaoDoPagamento()->getId(),
            "created_at" => Carbon::now(),
            "updated_at" => null
        ];
        if($reserva->getId() > 0){
            $dados["id"] = $reserva->getId();
        } 
        return DB::table("reserva")->insertGetId($dados);
    }

    public static function insertAll(Reserva $reservas){
        $ids = [];
        foreach($reservas as $reserva){
            $ids[count($ids)] = ReservaDAO::insert($reserva);
        }
        return $ids;
    }
    //-------------- INSERT --------------//

    //-------------- UPDATE --------------//
    public static function update_(Reserva $reserva){
        return DB::table("reserva")->where("id", $reserva->getId())->update([
            "data_entrada" => $reserva->getDataEntrada(),
            "data_saida" => $reserva->getDataSaida(),
            "valor_a_pagar" => $reserva->getValorAPagar(),
            "id_quarto" => $reserva->getQuarto()->getId(),
            "id_usuario" => $reserva->getUsuario()->getId(),
            "id_situacao_de_pagamento" => $reserva->getSituacaoDoPagamento()->getId(),
            "updated_at" => Carbon::now()
        ]);
    }
    public static function updateAll($reservas){
        $results = [];
        foreach($reservas as $reserva){
            $results[count($results)] = ReservaDAO::update_($reserva);
        }
        return $results;
    }
    //-------------- UPDATE --------------//
}
