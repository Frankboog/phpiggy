<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException, PDOStatement;

class database
{
    private PDO $connection;
    private PDOStatement $stmt;

    public function __construct(string $driver, array $config, string $username, string $password)
    {
        $dsn = "{$driver}:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

        try {
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Unable to connect to database: {$e->getMessage()}");
        }
    }

    public function query(string $query, array $params = []): Database
    {
        $this->stmt = $this->connection->prepare($query);

        $this->stmt->execute($params);

        return $this;
    }

    public function count()
    {
        return $this->stmt->fetchColumn();
    }

    public function find()
    {
        return $this->stmt->fetch();
    }

    public function findAll()
    {
        return $this->stmt->fetchAll();
    }

    public function id()
    {
        return $this->connection->lastInsertId();
    }
}
