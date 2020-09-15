<?php


class CommentController
{

    protected $commentRequest;
    protected $commentRepository;


    public function __construct($request)
    {
        $this->commentRepository=new CommentRepository();
        $this->commentRequest = new CommentRequest($request);
    }



    public function add()
    {
        if ($this->commentRequest->validateCreate()) {
            return;
        };

        $this->commentRepository->add($this->commentRequest->getInput('comment'), $this->commentRequest->getInput('article_id'));
        header('Location: /blog/article/?article=' . $this->commentRequest->getInput('slug'));
    }

    public function delete()
    {
       
        if($this->commentRepository->delete($this->commentRequest->getInput('admin'),$this->commentRequest->getInput('comment_id'),$this->commentRequest->getInput('author'))){
            return;
        }
        header('Location: /blog/article/?article=' . $this->commentRequest->getInput('slug'));

    }

    public function update()
    {

        $this->commentRepository->update($this->commentRequest->getInput('comm_author'),$this->commentRequest->getInput('id_comment'),$this->commentRequest->getInput('new_content'));
       
        
        header('Location: /blog/article/?article=' . $this->commentRequest->getInput('redirect_comm'));
    }
}
