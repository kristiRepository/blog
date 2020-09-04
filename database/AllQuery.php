<?php

class AllQuery extends Query
{

    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }



    public  function setVerified($vkey)
    {
        $alreadyVerified = "SELECT verified FROM user WHERE vkey = '$vkey' ";
        $st = $this->pdo->prepare($alreadyVerified);
        $st->execute();
        $alreadyRes = $st->fetchAll();
        $query = "SELECT * FROM user WHERE vkey = '$vkey' AND verified='0' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $result = $statment->rowCount();
        if ($result == 1) {
            $update = "UPDATE user SET verified='1' WHERE vkey=:vkey LIMIT 1";
            $stmt = $this->pdo->prepare($update);
            $stmt->bindParam(":vkey", $vkey, PDO::PARAM_STR);
            $stmt->execute();
        }
        if ($alreadyRes[0]['verified'] == "1") {
            return true;
        }
        if ($result == 0) {
            throw new Exception("Cannot verify your email");
        }

        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllVerifiedUsers()
    {

        $query = "SELECT * FROM user WHERE verified='1' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $users = $statment->fetchAll(PDO::FETCH_CLASS, "User");
        return $users;
    }


    public function allArticlesWithUsersWithCategories(){
        $query="SELECT * FROM ((article INNER JOIN category ON article.category_id=category.id) INNER JOIN user ON article.user_id=user.id) ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $articles=$statment->fetchAll();
        return $articles;
        
    }

    public function getArticlesWithTags(){
        $query="SELECT * FROM ((article_tag INNER JOIN article ON article_tag.article_id=article.id) INNER JOIN tag ON article_tag.tag_id=tag.id )";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $articles=$statment->fetchAll();
        return $articles;
    }
    public function getArticlesAll(){
        $query="SELECT * FROM (category LEFT JOIN (article INNER JOIN user ON article.user_id=user.id ) ON category.id=article.category_id)  ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $articles=$statment->fetchAll();
        return $articles;
    }

    public function getTagsWithArticles(){
        $query="SELECT * FROM (tag LEFT JOIN (article_tag INNER JOIN article ON article_tag.article_id=article.id) ON tag.id=article_tag.tag_id)";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $articles=$statment->fetchAll();
        return $articles;
    }
}
