<?php

use Illuminate\Support\Facades\Route;
use App\Providers\LoginService;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\EstabelecimentoController;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(LoginService::usuariosIsConnected()){ //se tiver usuario logado redireciona pra /home
        return redirect('/home');
    }

    $view = view('index'); //instancia variável index

    //se tiver alguma mensagem a ser mostrada, a adiciona
    if(isset($_GET["mensagem"])){
        $mensagem = $_GET["mensagem"];
        $view->with(compact('mensagem'));
    }    
    return $view;
});

Route::get("/usuario/signUpPage", function(){
    return view("paginas/cadastrarUsuario");
});

Route::post("/logar", [UsuarioController::class, "logar"]);

Route::get("/deslogar", function(){
    LoginService::deslogar();
    return redirect("/");
});

Route::get("/home", [UsuarioController::class, "acessarHome"]);

Route::get("/minhasReservas", [ReservaController::class, "acessarMinhasReservas"]);


// Route::get("/estabelecimentos", ['uses' => 'EstabelecimentoController@acessarListarEstabelecimentos']);

Route::get("/buscarEstabelecimentos", [EstabelecimentoController::class, 'buscarEstabelecimentos']);

Route::get("/visualizarQuartos", [EstabelecimentoController::class, 'acessarVisualizarQuartosDisponiveis']);

// // rotas de cadastro
Route::post("/cadastrarUsuario", [UsuarioController::class, 'cadastrarUsuario']);

// Route::get("/pagarReserva", ['uses' => 'ReservaController@pagarReserva']);

// Route::get("/cancelarReserva", ['uses' => 'ReservaController@cancelarReserva']);

Route::get("/reservarQuarto", [ReservaController::class , 'reservarQuarto']);
