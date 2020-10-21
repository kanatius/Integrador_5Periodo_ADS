<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    private $id;
    private $usuario;
    private $quarto;
    private $dataHoraEntrada;
    private $dataHoraSaida;
    private $valorAPagar;
    private $situacaoDoPagamento;

    function __construct($id, $dataHoraEntrada, $dataHoraSaida)
    {
        $this->id = $id;
        $this->dataHoraEntrada = $dataHoraEntrada;
        $this->dataHoraSaida = $dataHoraSaida;
    }

    function getId()
    {
        return $this->id;
    }
    function getUsuario()
    {
        return $this->usuario;
    }
    function getQuarto()
    {
        return $this->quarto;
    }
    function getDataEntrada()
    {
        return $this->dataHoraEntrada;
    }
    function getDataSaida()
    {
        return $this->dataHoraSaida;
    }
    function getDataEntradaPadraoBR()
    {
        return date("d/m/Y", strtotime($this->dataHoraEntrada));
    }
    function getDataSaidaPadraoBR()
    {
        return date("d/m/Y", strtotime($this->dataHoraSaida));
    }
    function getValorAPagar()
    {
        return $this->valorAPagar;
    }
    function getSituacaoDoPagamento()
    {
        return $this->situacaoDoPagamento;
    }
    function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    function setQuarto($quarto)
    {
        $this->quarto = $quarto;
    }
    function setDataEntrada($dataEntrada)
    {
        $this->dataEntrada = $dataEntrada;
    }
    function setDataSaida($dataHoraSaida)
    {
        $this->dataSaida = $dataHoraSaida;
    }
    function setValorAPagar($valorAPagar)
    {
        $this->valorAPagar = $valorAPagar;
    }
    function setSituacaoDoPagamento($situacaoDePagamento)
    {
        $this->situacaoDoPagamento = $situacaoDePagamento;
    }
    function setAsWaitingPayment(){
        $this->situacaoDePagamento = SituacaoDePagamentoService::getSituacaoPagamentoAguardando();
    }
    function setAsPaid(){
        $this->situacaoDePagamento = SituacaoDePagamentoService::getSituacaoPagamentoPago();
    }
    function setAsCanceled(){
        $this->situacaoDoPagamento = SituacaoDePagamentoService::getSituacaoPagamentoCancelado();
    }
}
