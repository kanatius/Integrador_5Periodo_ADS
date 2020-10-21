<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarto extends Model
{
    private $id;
    private TipoDeQuarto $tipo;
    private Estabelecimento $estabelecimento;
    private $andar;
    private $numero;
    private $valor;
    private $reservas;

    function __construct($id, $andar, $numero, $valor)
    {
        $this->id = $id;
        $this->andar = $andar;
        $this->numero = $numero;
        $this->valor = $valor;
        $this->reservas = [];
    }

    function getId()
    {
        return $this->id;
    }
    function getTipoDeQuarto()
    {
        return $this->tipo;
    }
    function getAndar()
    {
        return $this->andar;
    }
    function getNumero()
    {
        return $this->numero;
    }
    function getValor()
    {
        return $this->valor;
    }
    function getEstabelecimento(){
        return $this->estabelecimento;
    }
    function getReservas(){
        return $this->reservas;
    }
    function setTipoDeQuarto(TipoDeQuarto $tipo)
    {
        $this->tipo = $tipo;
    }
    function setAndar($andar)
    {
        $this->andar = $andar;
    }
    function setNumero($numero)
    {
        $this->numero = $numero;
    }
    function setValor($valor)
    {
        $this->valor = $valor;
    }
    function setEstabelecimento(Estabelecimento $estabelecimento)
    {
        $this->estabelecimento = $estabelecimento;
    }
    function addReserva(Reserva $reserva){
        $reserva->setQuarto($this);
        $this->reservas[count($this->reservas)] = $reserva;
    }
}
