<?php

namespace App\Providers;

use App\Models\Usuario;
use App\Models\UsuarioDAO;
use App\Models\Reserva;

use Illuminate\Support\ServiceProvider;

use function PHPSTORM_META\type;

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
        if($email != ""){
            $usuario = UsuarioDAO::getByEmail($email);
            if(!is_null($usuario))
                return json_encode(get_object_vars($usuario));
        }
        return json_encode(null);
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
}
