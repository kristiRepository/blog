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



    public function add()
    {
        if ($this->commentRequest->validateCreate()) {
            return;
        };

        $this->comment->add([$this->commentRequest->getInput('comment'), $this->commentRequest->getInput('article_id'), $_SESSION['id']]);
        header('Location: /blog/article/?article=' . $this->commentRequest->getInput('slug'));
    }

    public function delete()
    {
        if ($this->commentRequest->getInput('admin') != "") {
            $this->comment->delete($this->commentRequest->getInput('comment_id'));
            header('Location: /dashboard/comments');
            return;
        } else if ($_SESSION['id'] != $this->commentRequest->getInput('author')) {
            header('Location: /blog/article/?article=' . $this->commentRequest->getInput('slug'));
            return;
        } else if ($_SESSION['id'] == $this->commentRequest->getInput('author')) {
            $this->comment->delete($this->commentRequest->getInput('comment_id'));
            header('Location: /blog/article/?article=' . $this->commentRequest->getInput('slug'));
            return;
        }
    }

    public function update()
    {
        if ($_SESSION['id'] != $this->commentRequest->getInput('comm_author')) {
            header('Location: /blog/article/?article=' . $this->commentRequest->getInput('redirect_comm'));
            return;
        } else {
            $this->comment->updateComment($this->commentRequest->getInput('id_comment'), $this->commentRequest->getInput('new_content'));

            header('Location: /blog/article/?article=' . $this->commentRequest->getInput('redirect_comm'));
            return;
        }
    }
}
