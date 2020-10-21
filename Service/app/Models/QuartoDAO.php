<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuartoDAO extends Model
{
    //-------------- GET --------------//
    public static function findById($id)
    {
        $row = DB::table("quarto")->where("id", $id)->first();
        return QuartoDAO::convertRowToObj($row);
    }

    public static function getAll()
    {
        $rows = DB::table("quarto")->get();
        return QuartoDAO::convertRowsToVectorOfObj($rows);
    }

    //get id
    public static function getIdEstabelecimento(Quarto $quarto)
    {
        $row = DB::table("quarto")->select("id_estabelecimento")->where("id", $quarto->getId())->first();
        if(!is_null($row))
            return $row->id_estabelecimento;
        return null;
    }

    public static function getIdTipoDeQuarto(Quarto $quarto)
    {
        $row = DB::table("quarto")->select("id_tipo_de_quarto")->where("id", $quarto->getId())->first();
        return $row->id_tipo_de_quarto;
    }
    //get id

    //get by id foreign key
    public static function getQuartosByIdEstabelecimento($idEstabelecimento)
    {
        $rows = DB::table("quarto")->where("id_estabelecimento", $idEstabelecimento)->get();
        return QuartoDAO::convertRowsToVectorOfObj($rows);
    }
    public static function getQuartosByIdTipoDeQuarto($idTipo)
    {
        $rows = DB::table("quarto")->where("id_tipo_de_quarto", $idTipo)->get();
        return QuartoDAO::convertRowsToVectorOfObj($rows);
    }
    //get by id foreign key

    //-------------- GET --------------//

    //-------------- INSERT --------------//
    public static function insert(Quarto $quarto)
    {
        $dados = [
            "andar" => $quarto->getAndar(),
            "numero" => $quarto->getNumero(),
            "valor" => $quarto->getValor(),
            "id_estabelecimento" => $quarto->getEstabelecimento()->getId(),
            "id_tipo_de_quarto" => $quarto->getTipoDeQuarto()->getId(),
            "created_at" => Carbon::now(),
            "updated_at" => null
        ];
        if ($quarto->getId() > 0) {
            $dados["id"] = $quarto->getId();
        }
        return DB::table("quarto")->insertGetId($dados);
    }

    public static function insertAll($quartos)
    {
        $ids = [];
        foreach ($quartos as $quarto) {
            $ids[count($ids)] = QuartoDAO::insert($quarto);
        }
        return $ids;
    }
    //-------------- INSERT --------------//

    //-------------- UPDATE --------------//
    public static function update_(Quarto $quarto)
    {
        $dados = [
            "andar" => $quarto->getAndar(),
            "numero" => $quarto->getNumero(),
            "valor" => $quarto->getValor(),
            "id_estabelecimento" => $quarto->getEstabelecimento()->getId(),
            "id_tipo_de_quarto" => $quarto->getTipoDeQuarto()->getId(),
            "updated_at" => Carbon::now()
        ];
        if ($quarto->getId() > 0) {
            $dados["id"] = $quarto->getId();
        }
        return DB::table("quarto")->where("id", $quarto->getId())->update($dados);
    }
    public static function updateAll($quartos)
    {
        $results = [];
        foreach ($quartos as $quarto) {
            $results[count($results)] = QuartoDAO::update_($quarto);
        }
        return $results;
    }
    //-------------- UPDATE--------------//

    //-------------- ADAPTER --------------//
    private static function convertRowToObj($row)
    {
        if (!is_null($row))
            return new Quarto($row->id, $row->andar, $row->numero, $row->valor);
        return null;
    }

    private static function convertRowsToVectorOfObj($rows)
    {
        $quartos = [];
        foreach ($rows as $row) {
            $quartos[count($quartos)] = QuartoDAO::convertRowToObj($row);
        }
        return $quartos;
    }
    //-------------- ADAPTER --------------//
}
