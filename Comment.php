<?php

class Comment
{

    protected $conn;
    protected $query;

    private $comment_body;
    private $id;
    private $user_id;
    private $article_id;

    public function __construct()
    {

        $config = require('config.php');
        $this->conn = Connection::create($config);
        $this->query = new AllQuery($this->conn);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCommentBody()
    {
        return $this->comment_body;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getArticleId()
    {
        return $this->article_id;
    }

    public function add($name)
    {
        $this->query->insert('comment', ['comment_body', 'article_id', 'user_id'], $name);
    }

    public function articleComments($article_title)
    {
        return $this->query->articleComments($article_title);
    }

    public function getAllComments()
    {
        return $this->query->articleComments('h');
    }

    public function delete($comment_id)
    {
        $this->query->delete('comment', 'id', $comment_id);
    }

    public function updateComment($id, $value)
    {
        $this->query->update('comment', 'comment_body', $value, 'id', $id);
    }
}
