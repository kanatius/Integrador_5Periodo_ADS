<?php

use Illuminate\Support\Facades\Route;
use App\Providers\LoginService;
use App\Http\Controllers\UsuarioController;

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

Route::get("/usuario/signInPage", function(){
    return view("paginas/cadastrarUsuario");
});

Route::post("/logar", [UsuarioController::class, "logar"]);

Route::get("/deslogar", [UsuarioController::class, "deslogar"]);

Route::get("/home", ['uses' => 'EstabelecimentoController@acessarHome']);

// Route::get("/estabelecimentos", ['uses' => 'EstabelecimentoController@acessarListarEstabelecimentos']);

// Route::get("/buscarEstabelecimentos", ['uses' => 'EstabelecimentoController@buscarEstabelecimentos']);

// Route::get("/minhasReservas", ['uses' => 'ReservaController@acessarMinhasReservas']);

// Route::get("/visualizarQuartos", ['uses' => 'EstabelecimentoController@acessarVisualizarQuartos']);

// // rotas de cadastro
// Route::post("/cadastrarUsuario", ['uses' => 'UsuarioController@CadastrarUsuario']);

// Route::get("/pagarReserva", ['uses' => 'ReservaController@pagarReserva']);

// Route::get("/cancelarReserva", ['uses' => 'ReservaController@cancelarReserva']);

// Route::get("/reservarQuarto", ['uses' => 'ReservaController@reservarQuarto']);
