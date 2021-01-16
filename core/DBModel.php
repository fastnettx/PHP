<?php


namespace app\core;


class DBModel extends Database
{


    public function insert(string $sql, $params = []): ?int
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
        return $this->pdo->lastInsertId();
    }

    public function update(string $sql, $params = [])
    {
        $sth = $this->pdo->prepare($sql);
        return $sth->execute($params);
    }


    public function delete(string $sql): bool
    {
        return $this->pdo->exec($sql);
    }

    public function select(string $sql, $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        if (false === $result) {
            return null;
        }
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    public function select_all(string $sql, $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        if (false === $result) {
            return null;
        }
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }


}