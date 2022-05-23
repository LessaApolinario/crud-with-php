<?php
require_once "./IDatabase.php";
require_once "./config/config.php";

class MySQLDatabase implements IDatabase
{
    private $connection;

    // Variáveis de acesso ao banco de dados
    private $host;
    private $username;
    private $dbname;
    private $password;

    private $tableName;

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
        $this->connection = new PDO("mysql:host:$this->host;dbname:$this->dbname", $this->username, $this->password);
        $this->connection->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
    }

    public function insert($values, $data)
    {
        $sql = "INSERT INTO $this->tableName ($values) VALUES ($data)";
        return $this->connection->prepare($sql);
    }

    public function update($data, $where)
    {
        $sql = "UPDATE $this->tableName SET $data WHERE $where";
        return $this->connection->prepare($sql);
    }

    public function select($columns = "*", array $filters = null)
    {
        $sql = "SELECT $columns FROM $this->tableName";
        $sql .= $filters ? "WHERE $filters" : "";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete($where)
    {
        $sql = "DELETE FROM $this->tableName WHERE $where";
        return $this->connection->prepare($sql);
    }

    public function close()
    {
        $this->connection->close();
    }

    public function setTableName($name)
    {
        $this->tableName = $name;
    }
}
