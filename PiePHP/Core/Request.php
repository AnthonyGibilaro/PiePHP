<?php

namespace Core;

class Request
{
    private $get;
    private $post;

    public function __construct()
    {
        $this->get = $this->sanitizeKey($_GET);
        $this->post = $this->sanitizeKey($_POST);
    }

    public function getParams()
    {
        return $this->get;
    }
    public function postParams()
    {
        return $this->post;
    }
    public function get($key)
    {
        return isset($this->get[$key]) ? $this->get[$key] : null;
    }
    public function post($key)
    {
        return isset($this->post[$key]) ? $this->post[$key] : null;
    }

    private function sanitizeKey($variable)
    {
        $sanitizeDate = [];
        foreach ($variable as $key => $value) {
            $sanitizeDate[$key] = htmlspecialchars(trim(stripslashes($value)));
        }
        return $sanitizeDate;
    }
}
