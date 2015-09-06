<?php
namespace Controllers;

use Models\Article;
use Models\ArticleQuery;
use Components\Controller;
use Exceptions\ResourceNotFoundException;

class ArticleController extends Controller {

    /**
     * @return string
     */
    public function getArticles() {
        $articles = ArticleQuery::create()->find();
        return $this->response($articles->toArray());
    }

    /**
     * @param $id
     * @return string
     * @throws ResourceNotFoundException
     */
    public function getArticle($id) {
        $article = ArticleQuery::create()->findPk($id);
        if (!$article) {
            throw new ResourceNotFoundException($id);
        }
        return $this->response($article->toArray());
    }

    /**
     * @return string
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function postArticle() {
        $data = \Kernel::getInstance()->app->request()->post();
        $article = new Article();
        $article->fromArray($data);
        return $this->response(['success' => (bool)$article->save()], 201);
    }

    /**
     * @param $id
     * @return string
     * @throws ResourceNotFoundException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function putArticle($id) {
        $article = ArticleQuery::create()->findPk($id);
        if (!$article) {
            throw new ResourceNotFoundException($id);
        }
        $data = \Kernel::getInstance()->app->request()->post();
        $article->fromArray($data);
        return $this->response(['success' => (bool)$article->save()]);
    }

    /**
     * @param $id
     * @return string
     * @throws ResourceNotFoundException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteArticle($id) {
        $article = ArticleQuery::create()->findPk($id);
        if (!$article) {
            throw new ResourceNotFoundException($id);
        }
        $article->delete();
        return $this->response([], 204);
    }
}