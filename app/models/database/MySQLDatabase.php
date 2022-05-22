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

    private $tableName;
    private $fields;

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

    // Este campo é um array de campos de uma tabela do banco de dados separados por vírgula
    public function getFields()
    {
        return $this->fields;
    }

    public function setFields($fields): void
    {
        $this->fields = $fields;
    }

    public function connect()
    {
        $this->pdo = new PDO("msql:host:$this->host;dbname:$this->dbname", $this->username, $this->password);
    }

    public function insert($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO :table (:values) VALUES :data");
        $stmt->bindValue(":table", $this->getTableName());
        $stmt->bindValue(":values", $this->getFields());
        $stmt->bindValue(":data", $data);
        return $stmt->execute();
    }

    public function update($data, $where)
    {
        $stmt = $this->pdo->prepare("UPDATE :table SET :data WHERE :where");
        $stmt->bindValue(":table", $this->getTableName());
        $stmt->bindValue(":data", $data);
        $stmt->bindValue(":where", $where);
        return $stmt->execute();
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
        $stmt = $this->pdo->close();
    }

    public function setTableName($name)
    {
        $this->tableName = $name;
    }
}
