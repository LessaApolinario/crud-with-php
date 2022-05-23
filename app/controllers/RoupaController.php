<?php
define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . "/models/Roupa.php";
require_once ROOT_PATH . "/models/RoupaDAO.php";

class RoupaController
{
    private $roupa;
    private $roupaDAO;

    public function cadastrar()
    {
        $nome = $_REQUEST["nome"];
        $preco = $_REQUEST["preco"];
        $descricao = $_REQUEST["descricao"];
        $numero = $_REQUEST["numero"];
        $quantidade = $_REQUEST["quantidade"];
        $this->roupa = new Roupa($nome, $preco, $descricao, $numero, $quantidade);
        $this->roupaDAO = new RoupaDAO();

        if ($this->roupaDAO->cadastrar($this->roupa)) {
            require_once "./views/roupa/cadastrar.php";
        }
    }
}