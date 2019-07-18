<?php

namespace App\DAO\MySQL\Essentia;

abstract class Conexao
{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct()
    {
        $host = getenv('ESSENTIA_MYSQL_HOST');
        $port = getenv('ESSENTIA_PORT');
        $user = getenv('ESSENTIA_MYSQL_USER');
        $pass = getenv('ESSENTIA_MYSQL_PASSWORD');
        $dbname = getenv('ESSENTIA_MYSQL_DBNAME');

        $dsn = "mysql:host={$host};dbname={$dbname};port={$port}";

        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
    }
}
