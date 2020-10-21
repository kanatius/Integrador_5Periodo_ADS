<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacaoDePagamentoDAO extends Model
{
     //-------------- GET --------------//
     public static function findById($id){
        $row = DB::table("situacao_de_pagamento")->where("id", $id)->first();
        return SituacaoDePagamentoDAO::convertRowToObj($row);
    }

    public static function getAll(){
        $rows = DB::table("situacao_de_pagamento")->get();
        return SituacaoDePagamentoDAO::convertRowsToVectorOfObj($rows);
    }
    //-------------- GET --------------//

    //-------------- INSERT --------------//
    public static function insert(SituacaoDePagamento $situacaoDePagamento){
        $dados = [
            "nome" => $situacaoDePagamento->getNome(),
            "created_at" => Carbon::now(),
            "updated_at" => null
        ];
        if($situacaoDePagamento->getId() > 0)
            $dados["id"] = $situacaoDePagamento->getId();
            
        return DB::table("situacao_de_pagamento")->insert($dados);
    }
    public static function insertAll($situacoesDePagamento){
        $ids = [];
        foreach($situacoesDePagamento as $situacaoDePagamento){
            $ids[count($ids)] = SituacaoDePagamentoDAO::insert($situacaoDePagamento);
        }
        return $ids;
    }
    //-------------- INSERT --------------//

    //-------------- UPDATE --------------//
    public static function update_(SituacaoDePagamento $situacaoDePagamento){
        return DB::table("situacao_de_pagamento")->where("id", $situacaoDePagamento->getId())->update([
            "nome" => $situacaoDePagamento->getNome(),
            "updated_at" => Carbon::now()
        ]);
    }
    public static function updateAll($situacoesDePagamento){
        $results = [];
        foreach($situacoesDePagamento as $situacao){
            $results[count($results)] = SituacaoDePagamentoDAO::update_($situacao);
        }
        return $results;
    }
    //-------------- UPDATE --------------//

    //-------------- ADAPTER --------------//
    private static function convertRowToObj($row){
        if(!is_null($row))
            return new SituacaoDePagamento($row->id, $row->nome);
        return null;
    }
    private static function convertRowsToVectorOfObj($rows){
        $tipos = [];
        foreach($rows as $row){
            $tipos[count($tipos)] = SituacaoDePagamentoDAO::convertRowToObj($row);
        }
        return $tipos;
    }
    //-------------- ADAPTER --------------//
}
