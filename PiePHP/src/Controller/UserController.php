<?php

namespace Controller;

use Core\Controller;
use Model\UserModel;
use Core\Request;

class UserController extends Controller
{
    protected $request;
    public function __construct()
    {
        $this->request = new Request();
    }

    public function editAction()
    {
        session_start();
        $me = new UserModel([]);
        $me = $me->findAll(array(
            "WHERE" => "id = {$_SESSION['id']}",
        ))[0] ?? null;
        $this->render('edit', array('me' => $me));
    }

    public function editDbAction()
    {
        session_start();

        $userModel = new UserModel($this->request->postParams());
        $error = $userModel->update($_SESSION['id']);

        if (!$error) {
            $error = str_replace('\'', '\\\'', $error);
            echo "<script>alert('Une erreur est survenue');window.location.href='/PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/User/show';</script>";
        }
        header('Location: /PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/User/Show');
    }
    public function registerAction()
    {
        $this->render('register');
    }

    public function loginAction()
    {
        $this->render('login');
    }

    public function deleteAccountAction()
    {
        session_start();
        $userModel = new UserModel([]);
        $userModel->delete($_SESSION['id']);
        $this->logoutAction();
    }
    public function logoutAction()
    {
        session_start();
        session_destroy();
        header('Location: /PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/User/Login');
    }

    public function showAction()
    {
        session_start();
        $me = new UserModel([]);

        $me = $me->findAll(array(
            "WHERE" => "id = {$_SESSION['id']}",
        ))[0] ?? null;
        $this->render('show', array('me' => $me));
    }

    public function signupUserAction()
    {
        $userModel = new UserModel($this->request->postParams());
        $error = $userModel->register();

        if ($error) {
            $error = str_replace('\'', '\\\'', $error);
            echo "<script>alert('$error'); window.location.href='/PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/User/Register';</script>";
        } else {
            // Connexion automatique après l'inscription
            session_start();
            $user = $userModel->login();
            if ($user) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $this->request->post('email');
                header('Location: /PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/Movie/showall');
            }
        }
    }

    public function signinUserAction()
    {
        session_start();
        $email = $this->request->post("email");
        $password = $this->request->post("password");
        $userModel = new UserModel([
            'email' => $email,
            'password' => $password
        ]);
        $result = $userModel->login();
        if ($result != null) {
            $_SESSION['id'] = $result['id'];
            $_SESSION['email'] = $email;
            $_SESSION['firstname'] = $result['firstname'];
            $_SESSION['lastname'] = $result['lastname'];

            header('Location: /PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/Movie/showall');
        } else {
            // Afficher un message d'erreur et rediriger vers la page de connexion
            echo "<script>alert('Le compte n\'existe pas.'); window.location.href='/PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/User/Login';</script>";
        }
    }
};
