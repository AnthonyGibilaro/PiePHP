<?php

namespace Model;

use Core\Entity;

class ArticleModel extends Entity
{
    protected $table = 'article';

    function __construct($array)
    {
        $this->array = $array;
        $this->relations = array(
            'manyToOne' => 'comment',
            'manyToMany' => 'tag',
        );
        parent::__construct();
    }
}
