<?php

class CommentRepository
{


   
    protected $comment;


    public function __construct()
    {
        $this->comment = new Comment();
      
    }

    public function add($comment, $article_id)
    {
        $this->comment->add([$comment, $article_id, $_SESSION['id']]);
    }

    public function delete($admin, $comment_id, $author)
    {
        if ($admin != "") {
            $this->comment->delete($comment_id);
            header('Location: /dashboard/comments');
            return true;
        } else if ($_SESSION['id'] != $author) {

            return false;
        } else if ($_SESSION['id'] == $author) {
            $this->comment->delete($comment_id);

            return false;
        }
    }

    public function update($comm_author,$id_comment,$new_content)
    {
        if ($_SESSION['id'] == $comm_author) {
            $this->comment->updateComment($id_comment, $new_content);
        }
    }
}
