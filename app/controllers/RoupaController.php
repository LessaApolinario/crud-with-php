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
        $this->roupa = new Roupa();
        $this->roupa->setNome($_REQUEST["nome"]);
        $this->roupa->setPreco($_REQUEST["preco"]);
        $this->roupa->setDescricao($_REQUEST["descricao"]);
        $this->roupa->setNumero($_REQUEST["numero"]);
        $this->roupa->setQuantidade($_REQUEST["quantidade"]);

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
        $this->roupa = new Roupa();
        $this->roupa->setNome($_REQUEST["nome"]);
        $this->roupa->setPreco($_REQUEST["preco"]);
        $this->roupa->setDescricao($_REQUEST["descricao"]);
        $this->roupa->setNumero($_REQUEST["numero"]);
        $this->roupa->setQuantidade($_REQUEST["quantidade"]);
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

    public function deletar()
    {
        $this->roupa = new Roupa();
        $this->roupa->setId($_REQUEST["id"]);

        try {
            $this->roupaDAO = new RoupaDAO();

            if ($this->roupaDAO->deletar($this->roupa->getId())) {
                echo "Roupa deletada com sucesso";
            } else {
                echo "Erro ao deletar roupa";
            }
        } catch (PDOException $error) {
            echo "Impossível conectar! Por favor verifique o servidor de banco de dados.";
        }
    }
}