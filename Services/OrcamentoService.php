<?php

namespace App\Services;

use App\Http\Controllers\DatabaseController;
use App\Helpers\Logger;
use App\Models\Orcamento;
use PDO;

class OrcamentoService
{
    public function __construct(DatabaseController $db)
    {
        $this->table = 'orcamentos';
        $this->db = $db->connect();
    }

    /**
     * @throws Exception
     */
    public function store(Orcamento $model)
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("INSERT INTO orcamentos (`option`,name,value) VALUES (:option,:name,:value);");

            $query->bindParam(':name', $model->name, PDO::PARAM_STR);
            $query->bindParam(':value', $model->value, PDO::PARAM_INT);
            $query->bindParam(':option', $model->option, PDO::PARAM_INT);

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
    public function update(Orcamento $model)
    {
        try {
            $this->db->beginTransaction();

            Logger::log($model->id);

            $query = $this->db->prepare("UPDATE orcamentos SET `name` = :name,`value` = :value, `option` = :option WHERE `id` = :id;");

            $query->bindParam(':name', $model->name, PDO::PARAM_STR);
            $query->bindParam(':value', $model->value, PDO::PARAM_INT);
            $query->bindParam(':option', $model->option, PDO::PARAM_INT);
            $query->bindParam(':id', $model->id, PDO::PARAM_INT);

            $query->execute();

            $this->db->commit();
        } catch (\Throwable $e) {
            throw $e;
            $this->db->rollBack();
        }
    }
    public function get()
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("SELECT * FROM orcamentos;");

            $query->execute();

            $result = $query->fetchAll();

            $result = array_map(function ($orcamento) {
                return new Orcamento($orcamento["id"], $orcamento["name"], $orcamento["value"], $orcamento["option"]);

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

            $query = $this->db->prepare("DELETE FROM orcamentos WHERE `id` = :id;");

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

            $query = $this->db->prepare("SELECT * FROM orcamentos WHERE `id` = :id;");

            $query->bindParam(':id', $id, PDO::PARAM_INT);

            $query->execute();

            $result = $query->fetch();

            $result = new Orcamento($result["id"], $result["name"], $result["value"], $result["option"]);

            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
        return $result;
    }
}
