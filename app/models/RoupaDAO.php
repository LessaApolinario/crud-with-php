<?php
require_once "./database/MySQLDatabase.php";
require_once "./DAO.php";

class RoupaDAO extends DAO
{
    private $database;
    private $tableName = "roupa";

    public function __construct()
    {
        $this->database = new MySQLDatabase();
        parent::__construct($this->database);
        parent::setTableName($this->tableName);
    }

    // create
    public function cadastrar($roupa) {
        $values = "nome, preco, descricao, numero, quantidade";
        $data = ":nome, :preco, :descricao, :numero, :quantidade";
        $stmt = $this->database->insert($values, $data);
        $stmt->bindValue(":nome", $roupa->getNome());
        $stmt->bindValue(":preco", $roupa->getPreco());
        $stmt->bindValue(":descricao", $roupa->getDescricao());
        $stmt->bindValue(":numero", $roupa->getNumero());
        $stmt->bindValue(":quantidade", $roupa->getQuantidade());
        return $stmt->execute();
    }
}