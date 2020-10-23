<?php

namespace App\Http\Controllers;

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

    public function deslogar(){
        session_start();
        unset($_SESSION["usuarioLogado"]);
        session_commit();
        return redirect("/");
    }

    // public function cadastrarUsuario(){
    //     $usuario = new Usuario(0, $_POST["nome"], $_POST["email"]);
    //     $id = UsuarioService::cadastrarUsuario($usuario);
    //     if($id > 0)
    //         return redirect("/?mensagem=Usuario cadastrado com sucesso!");
    //     return redirect("/");
    // }
}
