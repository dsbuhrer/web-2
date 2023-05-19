<?php

namespace App\Services;

use App\Http\Controllers\DatabaseController;
use App\Helpers\Logger;
use App\Models\Pagamento;
use PDO;

class PagamentoService
{
    public function __construct(DatabaseController $db)
    {
        $this->table = 'pagamentos';
        $this->db = $db->connect();
    }

    /**
     * @throws Exception
     */
    public function store(Pagamento $model): void
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("INSERT INTO pagamentos (nome)
            VALUES (:nome);");
            
            $query->bindParam(':nome', $model->nome, PDO::PARAM_STR);

            $query->execute();

            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    /**
     * @throws Exception
     */
    public function update(Pagamento $model): void
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("UPDATE pagamentos SET `nome` = :nome WHERE `id` = :id;");

            $query->bindParam(':nome', $model->nome, PDO::PARAM_STR);
            $query->bindParam(':id', $model->id, PDO::PARAM_INT);

            $query->execute();

            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function get(): Array
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("SELECT * FROM pagamentos;");

            $query->execute();

            $result = $query->fetchAll();

            $result = array_map(function ($pagamento) {
                return new Pagamento($pagamento["id"], $pagamento["nome"]);
            }, $result);

            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
        return $result;
    }

    public function delete($id): void
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("DELETE FROM pagamentos WHERE `id` = :id;");

            $query->bindParam(':id', $id);

            $query->execute();

            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    public function find($id): Pagamento
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("SELECT * FROM pagamentos WHERE `id` = :id;");

            $query->bindParam(':id', $id, PDO::PARAM_INT);

            $query->execute();

            $result = $query->fetch();

            $result = new Pagamento($result["id"], $result["nome"]);

            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
        return $result;
    }
}
