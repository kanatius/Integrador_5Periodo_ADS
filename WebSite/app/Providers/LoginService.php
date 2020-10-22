<?php

namespace App\Providers;

use App\Models\Usuario;
use Illuminate\Support\ServiceProvider;

class LoginService extends ServiceProvider
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
    public static function usuariosIsConnected(){
        if(!is_null(LoginService::getUsuarioLogado()))
            return true;
        return false;
    }

}
