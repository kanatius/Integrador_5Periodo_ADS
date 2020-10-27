<?php

namespace App\Models;

class Estabelecimento
{
    private $id;
    private $nome;
    private Endereco $endereco;
    private TipoDeEstabelecimento $tipoDeEstabelecimento;
    private $quartos;

    function __construct($id, $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->quartos = [];
    }
    function getId()
    {
        return $this->id;
    }
    function getNome()
    {
        return $this->nome;
    }
    function getEndereco()
    {
        return $this->endereco;
    }
    function getTipoDeEstabelecimento()
    {
        return $this->tipoDeEstabelecimento;
    }
    function getQuartos(){
        return $this->quartos;
    }
    function setNome($nome)
    {
        $this->nome = $nome;
    }
    function setEndereco(Endereco $endereco)
    {
        $this->endereco = $endereco;
    }
    function setTipoDeEstabelecimento($tipoDeEstabelecimento)
    {
        $this->tipoDeEstabelecimento = $tipoDeEstabelecimento;
    }
    function setQuartos($quartos){
        $this->quartos = $quartos;
    }
    function addQuarto(Quarto $quarto){
        $this->quartos[count($this->quartos)] = $quarto;
    }
    function addAllQuartos($quartos){
        foreach($quartos as $quarto){
            $this->addQuarto($quarto);
        }
    }
}
