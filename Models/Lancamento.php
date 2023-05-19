<?php

namespace App\Models;

use Exception;

class Lancamento
{

    public function __construct(
        int $id = null,
        string $valor,
        string $data_lancamento,
        string $descricao,
        string $tipo,
        string $pagamento_id,
        string $categoria_id
    )
    {
        $this->id = $id;
        $this->valor = $valor;
        $this->data_lancamento = $data_lancamento;
        $this->descricao = $descricao;
        $this->tipo = $tipo;
        $this->pagamento_id = $pagamento_id;
        $this->categoria_id = $categoria_id;
    }

    /**
     * @throws Exception
     */
    public static function validate(Lancamento $lancamento): void
    {
        if (!isset($lancamento->descricao) || $lancamento->descricao =="") {
            throw new Exception("Categoria é obrigatório");
        } else if (!isset($lancamento->data_lancamento) || $lancamento->data_lancamento =="") {
            throw new Exception("Data é obrigatório");
        } else if (!isset($lancamento->pagamento_id) || $lancamento->pagamento_id =="") {
            throw new Exception("Método de pagamento é obrigatório");
        } else if (!isset($lancamento->valor) || $lancamento->valor =="") {
            throw new Exception("Valor é obrigatório");
        } else if (!isset($lancamento->tipo) || $lancamento->tipo =="") {
            throw new Exception("Tipo de transação é obrigatório");
        } else if (!isset($lancamento->categoria_id) || $lancamento->categoria_id =="") {
            throw new Exception("Tipo de transação é obrigatório");
        }
    }
}