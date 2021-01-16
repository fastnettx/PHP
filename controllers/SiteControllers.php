<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Article;
use app\models\Comment;
use app\models\Image;
use app\validation\ArticleFormValidator;
use DateTime;


class SiteControllers extends Controller
{
    public function add_article(Request $request)
    {
        $model_article = new Article();
        if ($request->isPost()) {
            $body = array_map(fn($attr) => trim($attr), $request->getBody());
            if ($model_article->save($body)) {
                return $this->render('article_added',);
            }
            return $this->render('add_article', [
                'error' => $model_article->getErrors()
            ]);
        }
        return $this->render('add_article',);
    }

    public function list_articles()
    {
        $model_article = new Article();
        $all_articles = $model_article->getAllValues();
        return $this->render('list_articles', [
            'articles' => $all_articles
        ]);
    }

    public function show(Request $request)
    {
        $id = $request->getBody()['id'];
        $art = new Article();
        $comment = new Comment();
        $image = new Image();
        $comments = $comment->getCommentByID($id);
        $article = $art->getDataById($id);
        $images = $image->getImageById($id);

        if ($request->isPost() && !isset($_FILES['image'])) {
            $body = array_map(fn($attr) => trim($attr), $request->getBody());
            if ($comment->save($body)) {
                return $this->render('show_article', [
                    'article' => $article,
                    'comments' => $comments,
                ]);
            }
            return $this->render('show_article', [
                'error' => $comment->getErrors(),
                'article' => $article,
                'comments' => $comments,
            ]);
        }
        if (isset($_FILES['image'])) {
            if (!$image->save($_FILES['image'], $request->getBody()['id'])) {
                return $this->render('show_article', [
                    'error_image' => $image->getErrors(),
                    'comments' => $comments,
                    'article' => $article,
                ]);
            }

        }

        return $this->render('show_article', [
            'article' => $article,
            'comments' => $comments,
            'images' => $images
        ]);

    }


    public function edit(Request $request)
    {
        if ($request->isPost()) {
            $model_article = new Article();
            $body = array_map(fn($attr) => trim($attr), $request->getBody());

            if ($model_article->updateArticle($body)) {
                return $this->render('article_edit',);
            }
        }
        $id = $request->getBody()['id'];
        $article = new Article();
        $article_id = $article->getDataById($id);
        return $this->render('edit_article', [
            'article' => $article_id
        ]);

    }

    public function delete(Request $request)
    {
        $id = $request->getBody()['id'];
        $article = new Article();
        $article->deleteById($id);
        return $this->render('article_delete', [
            'id' => $id
        ]);
    }

    public function home()
    {
        return $this->render('home');
    }
}