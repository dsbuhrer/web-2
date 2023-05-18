<?php

namespace App\Http\Controllers;

use App\Traits\ViewTrait;

class IndexController {

    use ViewTrait;

    public function indexPagina()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $loader = new \Twig\Loader\FilesystemLoader('./views');
        $twig = new \Twig\Environment($loader); 
        $twig->addGlobal('session', $_SESSION);

        $this->view('inicio.index');
    }
}