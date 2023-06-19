<?php

namespace Model;

use Core\Entity;

class UserModel extends Entity
{
    protected $table = 'user';

    function __construct($array)
    {
        $this->array = $array;
        parent::__construct();
    }

    public function register()
    {
        $user = $this->findAll(array('WHERE' => "email = \"{$this->array['email']}\""))[0] ?? null;
        if ($user) {
            return "L'email est dejà utilisée";
        }
        if ($this->create()) {
            return null;
        } else {
            return "Une erreur est survenue";
        }
    }

    public function login()
    {
        $result = $this->findAll(
            array(
                'WHERE' => "email = \"{$this->array['email']}\" and password = \"{$this->array['password']}\""
            )
        );
        return $result[0] ?? null;
    }
}
