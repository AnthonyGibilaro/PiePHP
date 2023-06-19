<?php

namespace Controller;

use Core\Controller;
use Model\UserModel;
use Core\Request;
use Model\ArticleModel;
use Model\CommentModel;

class ArticleController extends Controller
{
    public function findAllAction()
    {
        $model = new ArticleModel([]);

        $result = $model->findAll();

        foreach ($result as $article) {
            $comments = $article['comment'] ?? [];
            $tags = $article['tag'] ?? [];


            echo "<h2>" . $article['title'] . "</h2>";


            foreach ($tags as $tag) {
                echo "#" . $tag['name'] . "  ";
            }
            echo "<br>";

            foreach ($comments as $comment) {
                echo "Truc a dit : " . $comment['text'] . "<br>";
            }
        }
    }

    public function findAction($args = [])
    {
        $model = new ArticleModel([]);

        $result = $model->findAll();

        foreach ($result as $article) {
            $comments = $article['comment'] ?? [];
            $tags = $article['tag'] ?? [];


            echo "<h2>" . $article['title'] . "</h2>";


            foreach ($tags as $tag) {
                echo "#" . $tag['name'] . "  ";
            }
            echo "<br>";

            foreach ($comments as $comment) {
                echo "Truc a dit : " . $comment['text'] . "<br>";
            }
        }
    }

    public function testCommentAction()
    {
        $model = new CommentModel([]);

        $result = $model->findAll();

        foreach ($result as $comment) {
            echo "{$comment['text']} dans larticle {$comment['article']['title']}<br>";
        }
    }
}
