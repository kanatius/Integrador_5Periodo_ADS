<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeQuarto extends Model
{
    private $id;
    private $nome;

    function __construct($id, $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
    }

    function getId()
    {
        return $this->id;
    }
    function getNome()
    {
        return $this->nome;
    }
    function setNome($nome)
    {
        $this->nome = $nome;
    }
}
