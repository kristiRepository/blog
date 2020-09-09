<?php


class CommentController
{

    protected $commentRequest;
    protected $comment;
  

    public function __construct($request)
    {
        $this->comment = new Comment();
        $this->commentRequest = new CommentRequest($request);
    }



    public function add(){
        if ($this->commentRequest->validateCreate()) {
            return;
        };

        $this->comment->add([$this->commentRequest->getInput('comment'),$this->commentRequest->getInput('article_id'),$_SESSION['id']]);
        header('Location: /blog/article/?article='.$this->commentRequest->getInput('slug'));
    }
}