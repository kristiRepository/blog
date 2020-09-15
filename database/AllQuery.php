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
        $query = "SELECT article.thumbnail AS thumbnail,article.slug AS slug,article.draft AS draft,article.id AS id, article.title AS title, article.summary AS summary, article.image AS image, category.category_name AS category_name,article.publish_date AS publish_date, article.status AS status,article.is_feature AS is_feature,user.username AS username   FROM ((article INNER JOIN category ON article.category_id=category.id) INNER JOIN user ON article.user_id=user.id) WHERE draft='1' ";
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
        $query = "SELECT article_tag.article_id AS article_id, tag.tag_name AS tag_name FROM ((article_tag INNER JOIN article ON article_tag.article_id=article.id) INNER JOIN tag ON article_tag.tag_id=tag.id )";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $articles = $statment->fetchAll();
        return $articles;
    }



    public function limitTagArticles($like, $query, $start, $limit)
    {
        $like = "'%" . $like . "%'";
        $query = "SELECT article.summary AS summary,article.title AS title,article.slug AS slug,article.thumbnail AS thumbnail FROM (tag LEFT JOIN (article_tag INNER JOIN article ON article_tag.article_id=article.id) ON tag.id=article_tag.tag_id) WHERE " . $query . " LIKE " . $like . " AND title IS NOT NULL AND status='published' ";
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
        $query = "SELECT article.summary AS summary,article.title AS title,article.slug AS slug,article.thumbnail AS thumbnail FROM category INNER JOIN article on category.id=article.category_id WHERE " . $query . " LIKE " . $like . "  AND title IS NOT NULL AND status='published' ";
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
        $query = "SELECT article.slug AS slug,article.title AS title FROM article WHERE user_id='$user' AND draft='0' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $mydrafts = $statment->fetchAll();
        return $mydrafts;
    }

    public function getdraft($slug, $user)
    {
        $query = "SELECT * FROM article WHERE user_id='$user' AND title=:title AND draft='0' ";
        $statment = $this->pdo->prepare($query);
        $statment->bindParam(":title", $slug, PDO::PARAM_STR);
        $statment->execute();
        $draft = $statment->fetchAll();
        return $draft;
    }

    public function postdraft($title, $slug, $summary, $body, $image, $thumbnail, $category_id, $metadata, $user_id, $id1)
    {
        $query = "UPDATE article SET title= :title,slug=:slug,summary=:summary,body=:body, image=:image,thumbnail=:thumbnail,category_id=:category_id,meta_data=:metadata,user_id=:user_id,draft='1' WHERE id=:id1 ";
        $statment = $this->pdo->prepare($query);
        $statment->bindParam(":title", $title, PDO::PARAM_STR);
        $statment->bindParam(":slug", $slug, PDO::PARAM_STR);
        $statment->bindParam(":summary", $summary, PDO::PARAM_STR);
        $statment->bindParam(":body", $body, PDO::PARAM_STR);
        $statment->bindParam(":image", $image, PDO::PARAM_STR);
        $statment->bindParam(":thumbnail", $thumbnail, PDO::PARAM_STR);
        $statment->bindParam(":category_id", $category_id, PDO::PARAM_STR);
        $statment->bindParam(":metadata", $metadata, PDO::PARAM_STR);
        $statment->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $statment->bindParam(":id1", $id1, PDO::PARAM_STR);
        $statment->execute();
    }

    public function getSingleArticle($title)
    {
        $query = "SELECT article.id AS id,article.title AS title,user.username AS username, article.publish_date AS publish_date, article.image AS image, article.body AS body,article.slug AS slug FROM ((article INNER JOIN category ON article.category_id=category.id) INNER JOIN user ON article.user_id=user.id) WHERE title =:title ";
        $statment = $this->pdo->prepare($query);
        $statment->bindParam(":title", $title, PDO::PARAM_STR);
        $statment->execute();
        return $statment->fetchAll();
    }

    public function articleComments($title)
    {
        $query = "SELECT comment.created_at AS created_at, comment.user_id AS user_id, comment.id AS comment_id, comment.comment_body AS comment_body, user.username AS username,user.profile_picture AS profile_picture, article.title AS title FROM ((comment INNER JOIN user ON comment.user_id=user.id) INNER JOIN article ON comment.article_id=article.id) ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $result0 = $statment->fetchAll();
        
        $query = $query . " WHERE title=:title ORDER BY comment.created_at";
        $statment = $this->pdo->prepare($query);
        $statment->bindParam(":title", $title, PDO::PARAM_STR);
        $statment->execute();
        $result1 = $statment->fetchAll();
        
        return [$result0, $result1];
        
    }
}
