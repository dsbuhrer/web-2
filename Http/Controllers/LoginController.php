<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Models\Usuario;
use App\Services\UsuarioService;
use App\Traits\ViewTrait;

class LoginController {

    use ViewTrait;

    public function __construct(UsuarioService $service)
    {
        $this->service = $service;
    }

    public function loginPagina()
    {
        $this->view('login.login');
    }
    public function login()
    {
        try {
            $user = new Usuario(
                null,
                input()->post('usuario')->getValue(),
                input()->post('senha')->getValue(),
            );

            $logged = $this->service->login($user);

            if($logged === true){
                $this->handleSession($logged);
                $_SESSION["usuario"] =input()->post('usuario')->getValue();
                response()->redirect('/inicio');
            }

            return $this->view('login.login',["error"=>"Usuário ou senha inválidos"]);
        } catch (\Exception $e) {
            return $this->view('login.login',["error"=>"Usuário ou senha inválidos"]);
        }
    }
    public function handleSession($logged)
    {
        if($logged === true){
            session_start();
            $_SESSION["logado"] = true; 
        }
    }
    public function logout()
    {   
        session_start();
        session_destroy();
        response()->redirect('/login');
    }
}