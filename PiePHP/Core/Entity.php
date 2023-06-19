<?php

namespace Core;

abstract class Entity
{
    private $orm;
    protected $table;
    protected $array = [];
    protected $relations = [];

    function __construct()
    {
        $this->orm = new ORM();
    }

    public function findAll($params = [])
    {
        return $this->orm->findAll($this->table, $params, $this->relations);
    }

    public function create()
    {
        return $this->orm->create($this->table, $this->array);
    }

    public function read($id)
    {
        return $this->orm->read($this->table, $id);
    }

    public function update($id)
    {
        return $this->orm->update($this->table, $id, $this->array);
    }

    public function delete($id)
    {
        return $this->orm->delete($this->table, $id);
    }

    public function readAll()
    {
        return $this->orm->findAll($this->table, '');
    }
}
