<?php

namespace App\Http\Controllers;

use App\Providers\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UsuarioController extends Controller
{
    public function logar(){
        
        //envia os dados para o pagamentoService
        //$resultado = pagamentoService.logar($dados);
        $resultOK = true; //simulando que veio true

        if(!$resultOK){
            $mensagem = "Não foi possível logar!";
            return redirect("/?mensagem=" . $mensagem);
        }
        $response = Http::post("http://localhost:7000/api/login", [
            "email" => $_POST["email"],
            "senha" => $_POST["senha"]
        ]);

        $objOfResponse = $response->json();
        
        if(!is_null($objOfResponse)){ //se retornou um usuario, registra o usuario na seção
            session_start();
            $usuarioObjSession = [
                "id" => $objOfResponse["id"], 
                "nome" => $objOfResponse["nome"],
                "email" => $objOfResponse["email"], 
                "token" => $objOfResponse["token"]
            ];
            $_SESSION["usuarioLogado"] = json_encode($usuarioObjSession);
            session_commit();
            return redirect("/home");
        }

        //se não achou usuario
        $mensagem = "Não foi possível realizar o login";
        return redirect("/?mensagem=" . $mensagem);
    }

    public function acessarHome()
    {
        //verifica se o usuário está logado
        if (!LoginService::usuariosIsConnected()) {
            return redirect("/");
        }
        $usuario = LoginService::getUsuarioLogado();
        $usuario["token"] = ""; //certificando que o token não vai passar para a página

        return view("paginas/home", compact('usuario'));
    }

    public function cadastrarUsuario(Request $request){
        
        $data = $request->input();

        if(!(isset($data["nome"]) && isset($data["senha"]) && isset($data["email"]))) //se tiver faltando algum dado
            return redirect("/cadastrarUsuario?mensagem=dados incompletos!");

        $nome = $data["nome"];
        $senha = $data["senha"];
        $email = $data["email"];

        $response = Http::post("http://localhost:7000/api/cadastrarUsuario", [
            "nome" => $nome,
            "senha" => $senha,
            "email" => $email
        ]);

        $respon = json_decode($response->json());

        if($respon->status == true)
            return redirect("/?mensagem=" . $respon->mensagem);
        
        return redirect("/usuario/signUpPage?mensagem=" . $respon->mensagem);
    }
}
