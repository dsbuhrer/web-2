<?php

namespace App\Services;

use App\Http\Controllers\DatabaseController;
use App\Helpers\Logger;
use App\Models\Categoria;
use PDO;

class CategoriaService
{
    public function __construct(DatabaseController $db)
    {
        $this->table = 'categorias';
        $this->db = $db->connect();
    }

    /**
     * @throws Exception
     */
    public function store(Categoria $model): void
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("INSERT INTO categorias (nome,descricao)
            VALUES (:nome,:descricao);");
            
            $query->bindParam(':nome', $model->nome, PDO::PARAM_STR);
            $query->bindParam(':descricao', $model->descricao, PDO::PARAM_STR);

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
    public function update(Categoria $model): void
    {
        try {
            $this->db->beginTransaction();

            Logger::log($model->id);

            $query = $this->db->prepare("UPDATE categorias SET `nome` = :nome,`descricao` = :descricao WHERE `id` = :id;");

            $query->bindParam(':nome', $model->nome, PDO::PARAM_STR);
            $query->bindParam(':descricao', $model->descricao, PDO::PARAM_STR);
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

            $query = $this->db->prepare("SELECT * FROM categorias;");

            $query->execute();

            $result = $query->fetchAll();

            $result = array_map(function ($categoria) {
                return new Categoria($categoria["id"], $categoria["nome"], $categoria["descricao"]);
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

            $query = $this->db->prepare("DELETE FROM categorias WHERE `id` = :id;");

            $query->bindParam(':id', $id);

            $query->execute();

            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    public function find($id): Categoria
    {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("SELECT * FROM categorias WHERE `id` = :id;");

            $query->bindParam(':id', $id, PDO::PARAM_INT);

            $query->execute();

            $result = $query->fetch();

            $result = new Categoria($result["id"], $result["nome"], $result["descricao"]);

            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
        return $result;
    }
}
