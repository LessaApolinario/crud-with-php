<?php
define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . "/models/Categoria.php";
require_once ROOT_PATH . "/models/CategoriaDAO.php";

class CategoriaController
{
    private $categoria;
    private $categoriaDAO;

    public function cadastrar()
    {
        $this->categoria = new Categoria();
        $this->categoria->setNome($_REQUEST["nome"]);

        try {
            $this->categoriaDAO = new CategoriaDAO();

            if ($this->categoriaDAO->cadastrar($this->categoria)) {
                require_once "./views/categoria/cadastrar.php";
            } else {
                echo "Categoria não cadastrada!";
            }
        } catch (PDOException $error) {
            echo "Impossível conectar! Por favor verifique o servidor de banco de dados.";
        }
    }

    public function listar()
    {
        try {
            $this->categoriaDAO = new CategoriaDAO();
            $categorias = $this->categoriaDAO->listar();

            $_REQUEST["categorias"] = $categorias;

            require_once "./views/categoria/listar.php";
        } catch (PDOException $error) {
            echo "Impossível conectar! Por favor verifique o servidor de banco de dados.";
        }
    }

    public function atualizar()
    {
        $this->categoria = new Categoria();
        $this->categoria->setNome($_REQUEST["nome"]);
        $this->categoria->setId($_REQUEST["id"]);

        try {
            $this->categoriaDAO = new CategoriaDAO();

            if ($this->categoriaDAO->atualizar($this->categoria)) {
                require_once "./views/categoria/atualizar.php";
            }
        } catch (PDOException $error) {
            echo "Impossível conectar! Por favor verifique o servidor de banco de dados.";
        }
    }

    public function deletar()
    {
        $this->categoria = new Categoria();
        $this->categoria->setId($_REQUEST["id"]);

        try {
            $this->categoriaDAO = new CategoriaDAO();

            if ($this->categoriaDAO->deletar($this->categoria->getId())) {
                echo "Categoria deletada com sucesso!";
            } else {
                echo "Erro ao deletar categoria!";
            }
        } catch (PDOException $error) {
            echo "Impossível conectar! Por favor verifique o servidor de banco de dados.";
        }
    }
}