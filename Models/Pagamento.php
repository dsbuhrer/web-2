<?php

namespace App\Models;

use Exception;

class Pagamento
{

    public function __construct(
        int $id = null,
        string $nome,
    )
    {
        $this->id = $id;
        $this->nome = $nome;
    }

    /**
     * @throws Exception
     */
    public static function validate(Pagamento $pagamento): void
    {
        if (!isset($pagamento->nome) || $pagamento->nome =="") {
            throw new Exception("Nome é obrigatório");
        }
    }
}