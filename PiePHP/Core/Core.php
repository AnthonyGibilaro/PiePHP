<?php

// namespace Core;

// class Core
// {
//     public function run()
//     {
//         require_once './src/routes.php';
//         $baseURL = '/PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro';
//         $requestURL = substr($_SERVER['REQUEST_URI'], strlen($baseURL));
//         $road = Router::get($requestURL);

//         if ($road != null) {
//             $class = "Controller\\" . $road["controller"] . "Controller";
//             if (class_exists($class)) {
//                 $controller = new $class();
//                 $action = $road['action'] . "Action";
//                 if (method_exists($controller, $action)) {
//                     $controller->$action();
//                     Router::connect('/register', ['controller' => 'User', 'action' => 'register']);
//                     $class = "Controller\\" . $road["controller"] . "Controller";
//                     $class = "Controller\UserController";
//                     $action = "registerAction";
//                     Controller\UserController->registerAction();
//                 }
//             }
//         }
//     }
// }


namespace Core;

class Core
{
    public function run()
    {
        $baseURL = '/PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro';
        $requestURL = substr($_SERVER['REQUEST_URI'], strlen($baseURL));
        $segments = explode('/', trim($requestURL, '/'));
        $controllerName = "Controller\\" . (isset($segments[0]) && !empty($segments[0]) ? ucfirst($segments[0])
            . "Controller" : 'AppController');
        $actionName = isset($segments[1]) && !empty($segments[1]) ? $segments[1] . "Action" : "indexAction";

        $args = count($segments) <= 2 ? [] : array_slice($segments, 2);

        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $actionName)) {
                $controller->$actionName($args);
            } else {
                echo "404 not found<br>";
            }
        } else {
            echo "404 not found<br>";
        }
    }
}