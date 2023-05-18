<?php

namespace App\Services;

use App\Http\Controllers\DatabaseController;
use App\Helpers\Logger;
use App\Models\Transacao;
use PDO;

class TransacaoService
{
    public function __construct(DatabaseController $db)
    {
        $this->table = 'transacoes';
        $this->db = $db->connect();
    }

    /**
     * @throws Exception
     */
    public function store(Transacao $model)
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("INSERT INTO transacoes (`option`,name,value,date,carteira_id,orcamento_id) VALUES (:option,:name,:value,:date,:carteira_id,:orcamento_id);");
            var_dump($model);
            $query->bindParam(':name', $model->name, PDO::PARAM_STR);
            $query->bindParam(':value', $model->value, PDO::PARAM_INT);
            $query->bindParam(':option', $model->option, PDO::PARAM_INT);
            $query->bindParam(':date', $model->date, PDO::PARAM_STR);
            $query->bindParam(':carteira_id', $model->carteira_id, PDO::PARAM_INT);
            $query->bindParam(':orcamento_id', $model->orcamento_id, PDO::PARAM_INT);

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
    public function update(Transacao $model)
    {
        try {
            $this->db->beginTransaction();

            Logger::log($model->id);

            $query = $this->db->prepare("UPDATE transacoes SET `name` = :name,`value` = :value, `option` = :option, `date` = :date WHERE `id` = :id;");

            $query->bindParam(':name', $model->name, PDO::PARAM_STR);
            $query->bindParam(':value', $model->value, PDO::PARAM_INT);
            $query->bindParam(':option', $model->option, PDO::PARAM_INT);
            $query->bindParam(':date', $model->date, PDO::PARAM_INT);
            $query->bindParam(':id', $model->id, PDO::PARAM_INT);
            $query->bindParam(':carteira_id', $model->carteira_id, PDO::PARAM_INT);
            $query->bindParam(':orcamento_id', $model->orcamento_id, PDO::PARAM_INT);

            $query->execute();

            $this->db->commit();
        } catch (\Throwable $e) {
            throw $e;
            $this->db->rollBack();
        }
    }
    public function get(): Array
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("SELECT * FROM transacoes;");

            $query->execute();

            $result = $query->fetchAll();

            $result = array_map(function ($transacao) {
                return new Transacao($transacao["id"], $transacao["name"], $transacao["option"], $transacao["value"],$transacao["date"]);

            }, $result);

            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
        return $result;
    }
    public function delete($id)
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("DELETE FROM transacoes WHERE `id` = :id;");

            $query->bindParam(':id', $id);

            $query->execute();

            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    public function find($id)
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("SELECT * FROM transacoes WHERE `id` = :id;");

            $query->bindParam(':id', $id, PDO::PARAM_INT);

            $query->execute();

            $result = $query->fetch();

            $result = new Transacao($result["id"], $result["name"], $result["option"], $result["value"],$result["date"]);

            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
        return $result;
    }
}
