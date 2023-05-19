<?php

namespace App\Http\Controllers;

use PDO;

define('MYSQL_HOST', '127.0.0.1');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', 'Auth123!@#');
define('MYSQL_DB_NAME', 'fluxo');

class DatabaseController
{

    public function __construct(
    ) {
        $this->pdo = null;
    }

    public function connect(): PDO
    {
        if ($this->pdo == null) {
            $this->pdo = new \PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);
        }
        return $this->pdo;
    }

    public function up(): void
    {
        try {
            $pdo = new \PDO('mysql:host=' . MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
            $pdo->beginTransaction();

            $query = file_get_contents("Database/schema.sql");

            $pdo->exec($query);

        } catch (\Throwable$e) {
            throw $e;
        }
    }
}
