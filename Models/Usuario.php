<?php

namespace App\Models;

use Exception;

class Usuario
{

    public function __construct(
        int $id = null,
        string $name,
        string $password,

    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * @throws Exception
     */
    public static function validate(Carteira $carteira): void
    {
        if (!isset($carteira->name)) {
            throw new Exception("Nome é obrigatório");
        } else if (!isset($carteira->password)) {
            throw new Exception("Valor é obrigatório");
        }
    }
}