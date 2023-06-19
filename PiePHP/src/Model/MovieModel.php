<?php

namespace Model;

use Core\Entity;

class MovieModel extends Entity
{
    protected $table = 'movie';

    function __construct($array)
    {
        $this->array = $array;
        $this->relations = array(
            'oneToMany' => 'distributor',
            'manyToMany' => 'genre',
        );
        parent::__construct();
    }
}
