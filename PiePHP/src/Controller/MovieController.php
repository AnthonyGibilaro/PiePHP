<?php

namespace Controller;

use Core\Controller;
use Model\UserModel;
use Core\Request;
use Model\MovieModel;

class MovieController extends Controller
{
    public function showAllAction()
    {
        $model = new MovieModel([]);

        $result = $model->findAll();

        $this->render('list', array(
            "movies" => $result
        ));
    }

    public function showAction($args = [])
    {
        $movieId = $args[0] ?? null;

        if ($movieId == null) {
            echo "Pas d'id fournis";
            return;
        }

        $model = new MovieModel([]);

        $result = $model->findAll(array(
            "WHERE" => "id = $movieId"
        ));

        $movie = $result[0] ?? null;

        if ($movie == null) {
            echo "Film non trouvé";
            return null;
        }

        $this->render('detail', array(
            "movie" => $movie,
            "distributor" => $movie['distributor'],
        ));
    }

    public function addAction()
    {
        $this->render('add');
    }

    public function addDbAction()
    {
        
    }
}
