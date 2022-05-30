<?php
require_once "database/MySQLDatabase.php";
require_once "DAO.php";

class CategoriaDAO extends DAO
{
    private $database;
    private $tableName = "categoria";

    public function __construct()
    {
        $this->database = new MySQLDatabase();
        parent::__construct($this->database);
        parent::setTableName($this->tableName);
    }

    public function cadastrar($categoria)
    {
        $values = "nome";
        $data = ":nome";
        $stmt = $this->database->insert($values, $data);
        $stmt->bindValue(":nome", $categoria->getNome());
        return $stmt->execute();
    }

    public function listar()
    {
        return $this->database->select("*", null);
    }

    public function atualizar($categoria)
    {
        $data = "nome = :nome";
        $stmt = $this->database->update($data, "id = :id");
        $stmt->bindvalue(":nome", $categoria->getNome());
        $stmt->bindValue(":id", $categoria->getId());
        return $stmt->execute();
    }

    public function deletar($id)
    {
        $stmt = $this->database->delete("id = :id");
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }
}