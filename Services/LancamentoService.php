<?php

namespace App\Services;

use App\Http\Controllers\DatabaseController;
use App\Helpers\Logger;
use App\Models\Lancamento;
use PDO;

class LancamentoService
{
    public function __construct(DatabaseController $db)
    {
        $this->table = 'lancamentos';
        $this->db = $db->connect();
    }

    /**
     * @throws Exception
     */
    public function store(Lancamento $model): void
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("INSERT INTO lancamentos (valor,data_lancamento,descricao,tipo,pagamento_id,categoria_id) VALUES (:valor,:data_lancamento,:descricao,:tipo,:pagamento_id,:categoria_id);");

            $query->bindParam(':valor', $model->valor, PDO::PARAM_STR);
            $query->bindParam(':data_lancamento', $model->data_lancamento, PDO::PARAM_STR);
            $query->bindParam(':descricao', $model->descricao, PDO::PARAM_STR);
            $query->bindParam(':tipo', $model->tipo, PDO::PARAM_STR);
            $query->bindParam(':pagamento_id', $model->pagamento_id, PDO::PARAM_INT);
            $query->bindParam(':categoria_id', $model->categoria_id, PDO::PARAM_INT);

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
    public function update(Lancamento $model): void
    {
        try {
            $this->db->beginTransaction();

            Logger::log($model->id);

            $query = $this->db->prepare("UPDATE lancamentos SET `valor` = :valor, `data_lancamento` = :data_lancamento, `descricao` = :descricao, `tipo` = :tipo, `pagamento_id` = :pagamento_id, `categoria_id` = :categoria_id WHERE `id` = :id;");

            $query->bindParam(':valor', $model->valor, PDO::PARAM_STR);
            $query->bindParam(':data_lancamento', $model->data_lancamento, PDO::PARAM_STR);
            $query->bindParam(':descricao', $model->descricao, PDO::PARAM_STR);
            $query->bindParam(':tipo', $model->tipo, PDO::PARAM_STR);
            $query->bindParam(':pagamento_id', $model->pagamento_id, PDO::PARAM_INT);
            $query->bindParam(':categoria_id', $model->categoria_id, PDO::PARAM_INT);
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

            $query = $this->db->prepare("SELECT * FROM lancamentos;");

            $query->execute();

            $result = $query->fetchAll();
            Logger::log("get lancamento");

            $result = array_map(function ($lancamento) {
                return new Lancamento($lancamento["id"], $lancamento["valor"], $lancamento["data_lancamento"], $lancamento["descricao"], $lancamento["tipo"], $lancamento["pagamento_id"], $lancamento["categoria_id"]);
            }, $result);
            Logger::log("get result");

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

            $query = $this->db->prepare("DELETE FROM lancamentos WHERE `id` = :id;");

            $query->bindParam(':id', $id);

            $query->execute();

            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    public function find($id): Lancamento
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("SELECT * FROM lancamentos WHERE `id` = :id;");

            $query->bindParam(':id', $id, PDO::PARAM_INT);

            $query->execute();

            $result = $query->fetch();

            $result = new Lancamento($result["id"], $result["valor"], $result["data_lancamento"], $result["descricao"], $result["tipo"], $result["pagamento_id"], $result["categoria_id"]);

            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
        return $result;
    }
}
