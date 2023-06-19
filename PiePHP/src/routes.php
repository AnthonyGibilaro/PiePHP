<?php

use Core\Router;

Router::connect('/', ['controller' => 'App', 'action' => 'index']);
Router::connect('/register', ['controller' => 'User', 'action' => 'register']);
Router::connect('/login', ['controller' => 'User', 'action' => 'login']);
