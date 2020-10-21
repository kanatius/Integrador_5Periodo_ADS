<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeQuartoDAO extends Model
{
    //-------------- GET --------------//
    public static function findById($id){
        $row = DB::table("tipo_de_quarto")->where("id", $id)->first();
        return TipoDeQuartoDAO::convertRowToObj($row);
    }
    public static function getAll(){
        $rows = DB::table("tipo_de_quarto")->get();
        return TipoDeQuartoDAO::convertRowsToVectorOfObj($rows);
    }
    //-------------- GET --------------//

    //-------------- INSERT --------------//
    public static function insert(TipoDeQuarto $tipoDeQuarto){
        $dados = [
            'id'=> $tipoDeQuarto->getId(), 
            "nome" => $tipoDeQuarto->getNome(), 
            "created_at" => Carbon::now(), 
            "updated_at" => null
        ];
        if($tipoDeQuarto->getId() > 0)
            $dados["id"] = $tipoDeQuarto->getId();

        return DB::table("tipo_de_quarto")->insertGetId($dados);
    }
    public static function insertAll($tiposDeQuarto){
        $ids = [];
        foreach($tiposDeQuarto as $tipo){
            $ids[count($ids)] = TipoDeQuartoDAO::insert($tipo);
        }
        return $ids;
    }
    //-------------- INSERT --------------//

   //-------------- UPADTE --------------//
    public static function update_(TipoDeQuarto $tipoDeQuarto){
        return DB::table("tipo_de_quarto")->where("id", $tipoDeQuarto->getId())->update([
            "nome" => $tipoDeQuarto->getNome(),
            "updated_at" => Carbon::now()
        ]);
    }
    public static function updateAll($tiposDeQuarto){
        $results = [];
        foreach($tiposDeQuarto as $tipoDeQuarto){
            $results[count($results)] = TipoDeQuartoDAO::update_($tipoDeQuarto);
        }
        return $results;
    }
    //-------------- UPADTE --------------//

    //-------------- ADAPTER --------------//
    private static function convertRowToObj($row){
        if(!is_null($row))
            return new TipoDeQuarto($row->id, $row->nome);
        return null;
    }
    private static function convertRowsToVectorOfObj($rows){
        $tipos = [];
        foreach($rows as $row){
            $tipos[count($tipos)] = TipoDeQuartoDAO::convertRowToObj($row);
        }
        return $tipos;
    }
    //-------------- ADAPTER --------------//
}
