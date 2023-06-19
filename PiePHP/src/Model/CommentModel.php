<?php

namespace Model;

use Core\Entity;

class CommentModel extends Entity
{
    protected $table = 'comment';

    function __construct($array)
    {
        $this->array = $array;
        $this->relations = array(
            'oneToMany' => 'article',
        );
        parent::__construct();
    }
}
