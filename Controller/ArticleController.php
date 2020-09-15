<?php


class ArticleController
{

    protected $articleRequest;
    protected $articleRepository;


    public function __construct($request)
    {
       
        $this->articleRequest = new ArticleRequest($request);
        $this->articleRepository=new ArticleRepository();
    }

    public function markArticle()
    {

        $this->articleRepository->mark($this->articleRequest->getInput('postId'));
        header('Location: /dashboard/articles');
    }
    public function unMarkArticle()
    {

        $this->articleRepository->unMark($this->articleRequest->getInput('postId'));
        header('Location: /dashboard/articles');
    }

    public function publishArticle()
    {
        $this->articleRepository->publish($this->articleRequest->getInput('articleId'));
        header('Location: /dashboard/articles');
    }

    public function unpublishArticle()
    {
        $this->articleRepository->unpublish($this->articleRequest->getInput('articleId'));
        header('Location: /dashboard/articles');
    }
}
