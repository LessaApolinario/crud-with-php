<?php
require_once "./IDatabase.php";
require_once "./config/config.php";

class MySQLDatabase implements IDatabase
{
    private $pdo;

    // Variáveis de acesso ao banco de dados
    private $host;
    private $username;
    private $dbname;
    private $password;

    public function __construct()
    {
        $this->host = HOST;
        $this->username = USER;
        $this->dbname = DB;
        $this->password = PASS;
        $this->connect();
    }

    public function connect()
    {
        $this->pdo = new PDO("msql:host:$this->host;dbname:$this->dbname", $this->username, $this->password);
    }

    public function insert($data)
    {
        // TODO: Implement insert() method.
    }

    public function update($data, $where)
    {
        // TODO: Implement update() method.
    }

    public function select($columns = "*", array $filters = null)
    {
        // TODO: Implement select() method.
    }

    public function delete($where)
    {
        // TODO: Implement delete() method.
    }

    public function close()
    {
        // TODO: Implement close() method.
    }

    public function setTableName()
    {
        // TODO: Implement setTableName() method.
    }
}
