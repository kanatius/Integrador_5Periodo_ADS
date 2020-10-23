<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstabelecimentoDAO extends Model
{
    //-------------- GET --------------//
    public static function findById($id){
        return DB::table("estabelecimento")->select("id", "nome", "id_endereco", "id_tipo_de_estabelecimento")->where("id", $id)->first();
    }

    public static function getAll(){
        return DB::table("estabelecimento")->get();
    }
    public static function getAllOrderedByNome(){
        return DB::table("estabelecimento")->orderBy("nome")->get();
    }
    //get id foreign key
    // public static function getIdTipoDeEstabelecimento(Estabelecimento $estabelecimento){
    //     $row = DB::table("estabelecimento")->select("id_tipo_de_estabelecimento")->where("id", $estabelecimento->getId())->first();
    //     return $row->id_tipo_de_estabelecimento;
    // }
    // public static function getIdEndereco(Estabelecimento $estabelecimento){
    //     $row = DB::table("estabelecimento")->select("id_endereco")->where("id", $estabelecimento->getId())->first();
    //     return $row->id_endereco;
    // }
    //get by foreign key
    public static function getByIdTipoDeEstabelecimento($id){
        return  DB::table("estabelecimento")->where("id_tipo_de_estabelecimento", $id)->get();
    }
    public static function getByIdEndereco($id){
        return DB::table("estabelecimento")->where("id_endereco", $id)->first();
    }
    //-------------- GET --------------//

    //-------------- INSERT --------------//
    // public static function insert(Estabelecimento $estabelecimento){
    //     $dados = [
    //         "nome" => $estabelecimento->getNome(), 
    //         "id_endereco" => $estabelecimento->getEndereco()->getId(), 
    //         "id_tipo_de_estabelecimento" => $estabelecimento->getTipoDeEstabelecimento()->getId(), 
    //         "created_at" => Carbon::now(), 
    //         "updated_at" => null
    //     ];
    //     if($estabelecimento->getId() > 0){
    //         $dados["id"] = $estabelecimento->getId();
    //     }
    //     return DB::table("estabelecimento")->insertGetID($dados);
    // }

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
    public static function removeById($id){
        return DB::table("estabelecimento")->where("id", $id)->delete();
    }
    public static function removeAll($estabelecimentos){
        $results = [];
        foreach($estabelecimentos as $estabelecimento){
            EstabelecimentoDAO::remove($estabelecimento);
        }
        return $results;
    }
    //-------------- REMOVE--------------//
}
