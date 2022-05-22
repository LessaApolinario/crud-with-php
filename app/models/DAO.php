<?php
require_once "./database/IDatabase.php";

class DAO implements IDatabase
{
    protected $adapter;

    public function __construct(IDatabase $object)
    {
        $this->adapter = $object;
        $this->connect();
    }

    public function connect()
    {
        $this->adapter->connect();
    }

    public function insert($values, $data)
    {
        $this->adapter->insert($values, $data);
    }

    public function update($data, $where)
    {
        $this->adapter->update($data, $where);
    }

    public function select($columns = "*", array $filters = null)
    {
        $this->adapter->select($columns, $filters);
    }

    public function delete($where)
    {
        $this->adapter->delete($where);
    }

    public function close()
    {
        $this->adapter->close();
    }

    public function setTableName($name)
    {
        $this->adapter->setTableName($name);
    }
}