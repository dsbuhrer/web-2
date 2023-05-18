<?php

namespace App\Traits;

use App\Helpers\Logger;

trait ViewTrait
{

    public function view($path, $dados = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('./views');
        $twig = new \Twig\Environment($loader);
        $twig->addGlobal("CurrentUrl", $_SERVER["REQUEST_URI"]);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $twig->addGlobal('session', $_SESSION);
        $twig->addGlobal('url', "http://" . $_SERVER['SERVER_NAME']);
        $path = $this->preparePath($path);

        $dados["logado"] = $this->checkLogin();
        echo $twig->render($path, $dados);
    }
    public function preparePath($path)
    {
        return str_replace('.','/',$path) . '.twig';
    }
    public function checkLogin()
    {
        session_start();
        if (isset($_SESSION["logado"]) && $_SESSION["logado"] == true) {
            return true;
        }
        return false;
    }
}