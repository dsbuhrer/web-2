<?php

namespace App\Models;

use Exception;

class Categoria
{

    public function __construct(
        int $id = null,
        string $nome,
        string $descricao,

    )
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
    }

    /**
     * @throws Exception
     */
    public static function validate(Categoria $categoria): void
    {
        if (!isset($categoria->nome) || $categoria->nome =="") {
            throw new Exception("Nome é obrigatório");
        } else if (!isset($categoria->descricao) || $categoria->descricao =="") {
            throw new Exception("Descrição é obrigatório");
        } 
    }
}