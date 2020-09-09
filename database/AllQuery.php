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


    public function allArticlesWithUsersWithCategories($start, $limit)
    {
        $query = "SELECT * FROM ((article INNER JOIN category ON article.category_id=category.id) INNER JOIN user ON article.user_id=user.id) WHERE draft='1' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $articles0 = $statment->fetchAll();
        $query = $query . " AND status='published'";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $total = $statment->rowCount();
        $articles1 = $statment->fetchAll();
        $query = $query . " LIMIT " . $start . "," . $limit . " ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $articles2 = $statment->fetchAll();
        return [$articles0, $articles1, $articles2, $total];
    }
    public function mainTotal()
    {
        $query = "SELECT * FROM article WHERE status='published' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        return $statment->rowCount();
    }

    public function getArticlesWithTags()
    {
        $query = "SELECT * FROM ((article_tag INNER JOIN article ON article_tag.article_id=article.id) INNER JOIN tag ON article_tag.tag_id=tag.id )";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $articles = $statment->fetchAll();
        return $articles;
    }



    public function limitTagArticles($like, $query, $start, $limit)
    {
        $like = "'%" . $like . "%'";
        $query = "SELECT * FROM (tag LEFT JOIN (article_tag INNER JOIN article ON article_tag.article_id=article.id) ON tag.id=article_tag.tag_id) WHERE " . $query . " LIKE " . $like . " AND title IS NOT NULL AND status='published' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $total = $statment->rowCount();
        $query = $query . " LIMIT " . $start . "," . $limit . " ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $articles = $statment->fetchAll();
        return [$articles, $total];
    }

    public function limitCategoryArticles($like, $query, $start, $limit)
    {
        $like = "'%" . $like . "%'";
        $query = "SELECT * FROM category LEFT JOIN article on category.id=article.category_id WHERE " . $query . " LIKE " . $like . "  AND title IS NOT NULL AND status='published' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $total = $statment->rowCount();
        $query = $query . " LIMIT " . $start . "," . $limit . " ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $articles = $statment->fetchAll();
        return [$articles, $total];
    }

    public function mydrafts($user)
    {
        $query = "SELECT * FROM article WHERE user_id='$user' AND draft='0' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $mydrafts = $statment->fetchAll();
        return $mydrafts;
    }

    public function getdraft($slug, $user)
    {
        $query = "SELECT * FROM article WHERE user_id='$user' AND title='$slug' AND draft='0' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $draft = $statment->fetchAll();
        return $draft;
    }

    public function postdraft($title, $slug, $summary, $body, $image, $thumbnail, $category_id, $metadata, $user_id)
    {
        $query = "UPDATE article SET title='$title',slug='$slug',summary='$summary',body='$body',image='$image',thumbnail='$thumbnail',category_id='$category_id',meta_data='$metadata',user_id='$user_id',draft='1' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
    }

    public function getSingleArticle($title)
    {
        $query = "SELECT * FROM ((article INNER JOIN category ON article.category_id=category.id) INNER JOIN user ON article.user_id=user.id) WHERE title = '$title' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        return $statment->fetchAll();
    }

    public function articleComments($article_title){
        $query="SELECT * FROM ((comment INNER JOIN user ON comment.user_id=user.id) INNER JOIN article ON comment.article_id=article.id) WHERE title='$article_title' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        return $statment->fetchAll();

    }
}
