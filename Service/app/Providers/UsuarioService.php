<?php

namespace App\Providers;

use App\Models\Usuario;
use App\Models\UsuarioDAO;
use App\Models\Reserva;

use Illuminate\Support\ServiceProvider;

class UsuarioService extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function autenticar($email){
        $usuario = UsuarioService::getByEmail($email); //pega os dados da tabela
    
        if(is_null($usuario)) //verifica se encontrou algum usuario cadastrado
            return false;

        session_start();
        $usuarioObjSession = ["id" => $usuario->getId(), "nome" => $usuario->getNome(), "email" => $usuario->getEmail()];
        $_SESSION["usuarioLogado"] = json_encode($usuarioObjSession);
        session_commit();
        return true;
    }

    public static function cadastrarUsuario(Usuario $usuario){

        //envia os dados para o servico de pagamento
        //$result = serviçoDePagamento.cadastrar($dados);
        
        $result = true; // simulando que o retorno foi true 
        $id = 0;
        if($result){
            $id = UsuarioDAO::insert($usuario); 
        }
        return $id;
    }
    public static function getByEmail($email){
        if($email != "")
            return UsuarioDAO::getByEmail($email);
        return null;
    }
    public static function getReservas(Usuario $usuario){
        $reservas = ReservaService::getReservasByUsuario($usuario); 
        foreach($reservas as $reserva){
            $reserva = ReservaService::getDataReserva($reserva);
        }
        return $reservas;  
    }
    public static function getUsuariosByNomeLikesTo($texto){
        return UsuarioDAO::getByNameLikesTo($texto);
    }
    public static function getUsuarioById($id){
        return UsuarioDAO::findById($id);
    }
    public static function getUsuarioByReserva(Reserva $reserva){
        $id = ReservaService::getIdUsuario($reserva);
        return UsuarioDAO::findById($id);
    }

    public static function getUsuarioLogado(){
        session_start();
        $usuario = null;

        if(isset($_SESSION["usuarioLogado"])){
            $usuario = json_decode($_SESSION["usuarioLogado"]);
            $usuario = new Usuario($usuario->id, $usuario->nome, $usuario->email);
        }
        session_commit();
        return $usuario;
    }
}
