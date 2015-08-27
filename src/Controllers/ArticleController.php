<?php
namespace Controllers;

/**
 * Created by PhpStorm.
 * User: devid
 * Date: 26.08.15
 * Time: 11:24
 */
class ArticleController extends Controller {

    public function getTest($id, $sid) {
        $this->response(['id' => $id, 'sid' => $sid]);
    }
    public function getArticles() {
        $this->response(['get articles']);
    }

    public function getArticle($id) {
        $this->response(['get article' => $id]);
    }

    public function postArticle() {
        $this->response(['post article']);
    }

    public function putArticle($id) {
        $this->response(['put article' => $id]);
    }

    public function deleteArticle($id) {
        $this->response(['delete article' => $id]);
    }
}