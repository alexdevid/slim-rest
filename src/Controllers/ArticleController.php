<?php
namespace Controllers;

use Components\Controller;

class ArticleController extends Controller {

    public function getTest($id, $sid) {
        $this->response(['id' => $id, 'sid' => $sid]);
    }

    public function getArticles() {
        $this->response(['get articles']);
    }

    public function getArticle($id) {
        $this->response([$id]);
    }

    public function postArticle() {
        $this->response(['post article']);
    }

    public function putArticle($id) {
        $this->response([$id]);
    }

    public function deleteArticle($id) {
        $this->response(['delete article' => $id]);
    }
}