<?php


class ArticleController
{

    protected $articleRequest;
    protected $article;


    public function __construct($request)
    {
        $this->article = new Article();
        $this->articleRequest = new ArticleRequest($request);
    }

    public function markArticle()
    {

        $this->article->mark($this->articleRequest->getInput('postId'));
        header('Location: /dashboard/articles');
    }
    public function unMarkArticle()
    {

        $this->article->unMark($this->articleRequest->getInput('postId'));
        header('Location: /dashboard/articles');
    }

    public function publishArticle()
    {
        $this->article->publish($this->articleRequest->getInput('articleId'));
        header('Location: /dashboard/articles');
    }

    public function unpublishArticle()
    {
        $this->article->unpublish($this->articleRequest->getInput('articleId'));
        header('Location: /dashboard/articles');
    }
}
