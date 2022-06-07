<?php
require_once "database/IDatabase.php";
require_once "database/MySQLDatabase.php";
require_once "DAO.php";

class RoupaDAO extends DAO
{
    private $database;
    private $tableName = "roupa";

    public function __construct(IDatabase $database)
    {
        $this->database = $database;
        parent::__construct($database);
        parent::setTableName($this->tableName);
    }

    // create
    public function cadastrar($roupa)
    {
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

    // read / list
    public function listar()
    {
        return $this->database->select("*", null);
    }

    // update
    public function atualizar($roupa)
    {
        $data = "nome = :nome, preco = :preco, descricao = :descricao, numero = :numero, quantidade = :quantidade";
        $stmt = $this->database->update($data, "id = :id");
        $stmt->bindValue(":nome", $roupa->getNome());
        $stmt->bindValue(":preco", $roupa->getPreco());
        $stmt->bindValue(":descricao", $roupa->getDescricao());
        $stmt->bindValue(":numero", $roupa->getNumero());
        $stmt->bindValue(":quantidade", $roupa->getQuantidade());
        $stmt->bindValue(":id", $roupa->getId());
        return $stmt->execute();
    }

    // delete / remove
    public function deletar($id)
    {
        $stmt = $this->database->delete("id = :id");
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }
}