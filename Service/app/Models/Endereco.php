<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    private $id;
    private $rua;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;

    function __construct($id, $rua, $numero, $bairro, $cidade, $estado)
    {
        $this->id = $id;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getRua()
    {
        return $this->rua;
    }
    public function getNumero()
    {
        return $this->numero;
    }
    public function getBairro()
    {
        return $this->bairro;
    }
    public function getCidade()
    {
        return $this->cidade;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setRua($rua)
    {
        $this->rua = $rua;
    }
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }
    public function setEstado($estado)
    {
        $this->cidade = $estado;
    }
    public function toString(){
        return $this->rua . " nº " . $this->numero . ", " . $this->bairro . ". " . $this->cidade . " - " . $this->estado . ".";
    }
}
