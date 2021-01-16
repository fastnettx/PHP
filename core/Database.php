<?php


namespace app\core;


class Database
{
    public \PDO $pdo;
    public $DIR_NAME;

    public function __construct()
    {
        $options = (require __DIR__ . '/../config/db_config.php')['db'];
        $this->pdo = new \PDO(
            'mysql:host=' . $options['host'] . ';dbname=' . $options['dbname'],
            $options['user'],
            $options['password']
        );
        $this->pdo->exec('SET NAMES UTF8');
        $this->DIR_NAME = (require __DIR__ . '/../config/file_config.php')['upload_dir'];
    }



}