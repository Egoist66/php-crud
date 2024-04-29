<?php

namespace Classes;
use PDOException;
use PDOStatement;
use PDO;

class DB
{

    private static ?Db $instance = null;
    public PDO $connection;
    private PDOStatement $stmt;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }

    public static function getInstance() : DB | null
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    final public function setConnection(array $db_config): DB | false
    {
        $dsn = "mysql:host={$db_config['db']['host']};dbname={$db_config['db']['dbname']};charset={$db_config['db']['charset']}";

        try {
            $this->connection = new PDO($dsn, $db_config['db']['username'], $db_config['db']['password'], $db_config['db']['options']);
            echo "<script>console.log('DB Connected!')</script>";
            return $this;
        } catch (PDOException $e) {
            echo "DB Error: {$e->getMessage()}";
            die;
        }
    }

    final public function query($query, $params = []): DB | false
    {
        $this->stmt = $this->connection->prepare($query);
        try {
            $this->stmt->execute($params);
        } catch (PDOException $e) {
            return false;
            // echo "DB Error: {$e->getMessage()}";
            // die;
        }
        return $this;
    }

    final public function find(): mixed
    {
        return $this->stmt->fetch();
    }

   final public function findAll() : array | false
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    final public function findColumn(): mixed
    {
        return $this->stmt->fetchColumn();
    }

}

