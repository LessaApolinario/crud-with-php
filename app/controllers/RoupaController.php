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

        try {
            $this->roupaDAO = new RoupaDAO();

            if ($this->roupaDAO->cadastrar($this->roupa)) {
                require_once "./views/roupa/cadastrar.php";
            }
        } catch (PDOException $error) {
            echo "Impossível conectar! Por favor verifique o servidor de banco de dados.";
        }
    }

    public function listar()
    {
        try {
            $this->roupaDAO = new RoupaDAO();
            $roupas = $this->roupaDAO->listar();

            $_REQUEST["roupas"] = $roupas;

            require_once "./views/roupa/listar.php";

        } catch (PDOException $error) {
            echo "Impossível conectar! Por favor verifique o servidor de banco de dados.";
        }
    }

    public function atualizar()
    {
        $nome = $_REQUEST["nome"];
        $preco = $_REQUEST["preco"];
        $descricao = $_REQUEST["descricao"];
        $numero = $_REQUEST["numero"];
        $quantidade = $_REQUEST["quantidade"];
        $this->roupa = new Roupa($nome, $preco, $descricao, $numero, $quantidade);
        $this->roupa->setId($_REQUEST["id"]);

        try {
            $this->roupaDAO = new RoupaDAO();
            $id = $this->roupa->getId();
            $idProcurado = $this->roupaDAO->buscarRoupa($id);

            if ($this->roupaDAO->atualizar($this->roupa) && $idProcurado) {
                require_once "./views/roupa/atualizar.php";
            }

        } catch (PDOException $error) {
            echo "Impossível conectar! Por favor verifique o servidor de banco de dados.";
        }
    }
}