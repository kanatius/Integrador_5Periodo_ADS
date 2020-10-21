<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstabelecimentoDAO extends Model
{
    //-------------- GET --------------//
    public static function findById($id){
        $row = DB::table("estabelecimento")->where("id", $id)->first();
        return EstabelecimentoDAO::convertRowToObj($row);
    }

    public static function getAll(){
        $rows = DB::table("estabelecimento")->get();
        return EstabelecimentoDAO::convertRowsToVectorOfObj($rows);
    }
    public static function getAllOrderedByNome(){
        $rows = DB::table("estabelecimento")->orderBy("nome")->get();
        return EstabelecimentoDAO::convertRowsToVectorOfObj($rows);
    }
    //get id foreign key
    public static function getIdTipoDeEstabelecimento(Estabelecimento $estabelecimento){
        $row = DB::table("estabelecimento")->select("id_tipo_de_estabelecimento")->where("id", $estabelecimento->getId())->first();
        return $row->id_tipo_de_estabelecimento;
    }
    public static function getIdEndereco(Estabelecimento $estabelecimento){
        $row = DB::table("estabelecimento")->select("id_endereco")->where("id", $estabelecimento->getId())->first();
        return $row->id_endereco;
    }
    //get by foreign key
    public static function getByIdTipoDeEstabelecimento($id){
        $rows = DB::table("estabelecimento")->where("id_tipo_de_estabelecimento", $id)->get();
        return EstabelecimentoDAO::convertRowsToVectorOfObj($rows);
    }
    public static function getByIdEndereco($id){
        $row = DB::table("estabelecimento")->where("id_endereco", $id)->first();
        return EstabelecimentoDAO::convertRowToObj($row);
    }
    //-------------- GET --------------//

    //-------------- INSERT --------------//
    public static function insert(Estabelecimento $estabelecimento){
        $dados = [
            "nome" => $estabelecimento->getNome(), 
            "id_endereco" => $estabelecimento->getEndereco()->getId(), 
            "id_tipo_de_estabelecimento" => $estabelecimento->getTipoDeEstabelecimento()->getId(), 
            "created_at" => Carbon::now(), 
            "updated_at" => null
        ];
        if($estabelecimento->getId() > 0){
            $dados["id"] = $estabelecimento->getId();
        }
        return DB::table("estabelecimento")->insertGetID($dados);
    }

    public static function insertAll($estabelecimentos){
        $ids = [];
        foreach($estabelecimentos as $estabelecimento){
            $ids[count($ids)] = EstabelecimentoDAO::insert($estabelecimento);
        }
        return $ids;
    }
    //-------------- INSERT --------------//

    //-------------- UPDATE --------------//
    public static function update_(Estabelecimento $estabelecimento){

        $dataEHoraAtual = Carbon::now()->format("d/m/Y H:i:s");
        
        return DB::table("estabelecimento")->where("id", $estabelecimento->getId())->update(["nome" => $estabelecimento->getNome(), "id_endereco" => $estabelecimento->getEndereco()->getId(), "id_tipo_de_estabelecimento" => $estabelecimento->getTipoDeEstabelecimeto()->getId(), "updated_at" => $dataEHoraAtual]);
    }
    public static function updateAll($estabelecimentos){
        $ids = [];
        foreach($estabelecimentos as $estabelecimento){
            $ids[count($ids)] = EstabelecimentoDAO::update_($estabelecimento);
        }
        return $ids;
    }
    //-------------- UPDATE --------------//

    //-------------- REMOVE--------------//
    public static function remove(Estabelecimento $estabelecimento){
        return DB::table("estabelecimento")->where("id", $estabelecimento->getId())->delete();
    }
    public static function removeAll($estabelecimentos){
        $results = [];
        foreach($estabelecimentos as $estabelecimento){
            EstabelecimentoDAO::remove($estabelecimento);
        }
        return $results;
    }
    //-------------- REMOVE--------------//

     //-------------- ADAPTER --------------//
     private static function convertRowToObj($row){
        if(!is_null($row))
            return new Estabelecimento($row->id, $row->nome);
        return null;
    }

    private static function convertRowsToVectorOfObj($rows){
        $quartos = [];
        foreach($rows as $row){
            $quartos[count($quartos)] = EstabelecimentoDAO::convertRowToObj($row);
        }
        return $quartos;
    }
    //-------------- ADAPTER --------------//
}
