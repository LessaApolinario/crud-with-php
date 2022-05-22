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

    // Método particular para acessar a tabela do banco de dados
    public function getTableName()
    {
        return $this->tableName;
    }

    public function connect()
    {
        $this->connection = new PDO("mysql:host:$this->host;dbname:$this->dbname", $this->username, $this->password);
        $this->connection->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
    }

    public function insert($values, $data)
    {
        $tableName = $this->getTableName();
        return $this->pdo->prepare("INSERT INTO $tableName ($values) VALUES ($data)");
    }

    public function update($data, $where)
    {
        $tableName = $this->getTableName();
        return $stmt = $this->pdo->prepare("UPDATE $tableName SET $data WHERE $where");
    }

    public function select($columns = "*", array $filters = null)
    {
        $stmt = $this->pdo->prepare("SELECT $columns FROM :table");
        $stmt->bindValue(":table", $this->getTableName());
        return $stmt->execute();
    }

    public function delete($where)
    {
        $stmt = $this->pdo->prepare("DELETE FROM :table WHERE :where");
        $stmt->bindValue(":table", $this->getTableName());
        $stmt->bindValue("where", $where);
        return $stmt->execute();
    }

    public function close()
    {
        $this->pdo->close();
    }

    public function setTableName($name)
    {
        $this->tableName = $name;
    }
}
