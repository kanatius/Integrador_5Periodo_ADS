<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        if(!UsuarioService::autenticar($_POST["email"])){
            $mensagem = "Não encontramos usuario com este email cadastrado!";
            return redirect("/?mensagem=" . $mensagem);
        }     
        return redirect("/home");
    }

    public function deslogar(){
        session_start();
        unset($_SESSION["usuarioLogado"]);
        session_commit();
        return redirect("/");
    }
    public function cadastrarUsuario(){
        $usuario = new Usuario(0, $_POST["nome"], $_POST["email"]);
        $id = UsuarioService::cadastrarUsuario($usuario);
        if($id > 0)
            return redirect("/?mensagem=Usuario cadastrado com sucesso!");
        return redirect("/");
    }
}
