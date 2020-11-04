<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    private $id;
    private $nome;
    private $email;
    private $reservas;
    private $token;

    function __construct($id, $nome, $email)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getReservas(){
        return $this->reservas;
    }
    public function getToken(){
        return $this->token;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setToken($token){
        $this->token = $token;
    }
    public function addReserva(Reserva $reserva){
        $tamanho = count($this->reservas);
        $this->reservas[$tamanho] = $reserva;
    }
    public function addAllReservas($reservas){
        foreach($reservas as $reserva){
            $this->addReserva($reserva);
        }
    }
    public function setReservas($reservas){
        $this->reservas = $reservas;
    }
}
