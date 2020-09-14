<?php

class Article
{

    protected $conn;
    protected $query;


    private $id;
    private $title;
    private $slug;
    private $summary;
    private $body;
    private $image;
    private $category_id;
    private $publish_date;
    private $status;
    private $is_feature;
    private $meta_data;
    private $user_id;


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
    public function getTitle()
    {
        return $this->title;
    }
    public function getSlug()
    {
        return $this->slug;
    }
    public function getSummary()
    {
        return $this->summary;
    }
    public function getBody()
    {
        return $this->body;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getCategoryId()
    {
        return $this->category_id;
    }
    public function getPublishDate()
    {
        return $this->publish_date;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getIsFeature()
    {
        return $this->is_feature;
    }
    public function getMetaData()
    {
        return $this->meta_data;
    }
    public function getUserId()
    {
        return $this->user_id;
    }

    public function getAllArticles($start, $limit)
    {
        return $this->query->allArticlesWithUsersWithCategories($start, $limit);
    }

    public function mark($postId)
    {
        $this->query->update('article', 'is_feature', '1', 'id', $postId);
    }
    public function unMark($postId)
    {
        $this->query->update('article', 'is_feature', '0', 'id', $postId);
    }

    public function publish($articleId)
    {
        $this->query->update('article', 'status', 'published', 'id', $articleId);
    }

    public function unpublish($articleId)
    {
        $this->query->update('article', 'status', 'unpublished', 'id', $articleId);
    }

    public function getArticlesWithTags()
    {
        return $this->query->getArticlesWithTags();
    }

    public function articlesNumber()
    {
        return $this->query->mainTotal();
    }

    public function filterTag($like, $query, $start, $limit)
    {
        return $this->query->limitTagArticles($like, $query, $start, $limit);
    }

    public function filterCategory($like, $query, $start, $limit)
    {
        return $this->query->limitCategoryArticles($like, $query, $start, $limit);
    }

    protected function resizejpeg($file, $max_resolution)
    {

        $original_image = imagecreatefromjpeg($file);

        //resolution 
        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);

        $ratio = $max_resolution / $original_width;
        $new_width = $max_resolution;
        $new_height = $original_height * $ratio;

        if ($new_height > $max_resolution) {
            $ratio = $max_resolution / $original_height;
            $new_height = $max_resolution;
            $new_width = $original_width * $ratio;
        }

        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
        imagejpeg($new_image, $file, 90);

        $watermark = imagecreatefrompng('watermark.png');
        $margin_right = 10;
        $margin_bottom = 10;

        $sx = imagesx($watermark);
        $sy = imagesy($watermark);

        $img = imagecreatefromjpeg($file);
        imagecopy($img, $watermark, imagesx($img) - $sx - $margin_right, imagesy($img) - $sy - $margin_bottom, 0, 0, $sx, $sy);
        $i = imagejpeg($img, $file);
    }



    public function resizeImage($image)
    {
        $file = "";

        if ($_FILES[$image]['type'] == 'image/jpeg') {
            $type = substr(strrchr($_FILES['image']['name'], '.'), 1);
            $i = strlen($type);
            $name = substr($_FILES['image']['name'], 0, strlen($_FILES['image']['name']) - $i - 1);
            move_uploaded_file($_FILES[$image]['tmp_name'], 'views/blog/blogphotos/' . $name . time() . "." . $type);
            copy('views/blog/blogphotos/' . $name . time() . "." . $type, 'views/blog/originalblogphotos/' . $name . time() . "." . $type);
            $original = 'views/blog/originalblogphotos/' . $name . time() . "." . $type;
            $file = 'views/blog/blogphotos/' . $name . time() . "." . $type;

            $this->resizejpeg($file, '300');
        }
        return [$original, $file];
    }

    public function add($data)
    {
        $this->query->insert('article', ['title', 'slug', 'summary', 'body', 'image', 'thumbnail', 'category_id', 'status', 'is_feature', 'meta_data', 'user_id', 'draft'], $data);
    }

    public function getLastId($title)
    {
        return $this->query->select('article', $title, 'title');
    }

    public function myDrafts()
    {
        return $this->query->mydrafts($_SESSION['id']);
    }

    public function getDraft($slug)
    {
        return $this->query->getdraft($slug, $_SESSION['id']);
    }

    public function getDraftTags($article)
    {
        return $this->query->select('article_tag', $article, 'article_id');
    }

    public function unchainTags($article)
    {
        $this->query->delete('article_tag', 'article_id', $article);
    }

    public function postDraft($title, $slug, $summary, $body, $image, $thumbnail, $category_id, $metadata, $title1)
    {
        $this->query->postdraft($title, $slug, $summary, $body, $image, $thumbnail, $category_id, $metadata, $_SESSION['id'], $title1);
    }

    public function deleteDraft($article)
    {
        $this->query->delete('article', 'id', $article);
    }

    public function getSingleArticle($title)
    {
        return $this->query->getSingleArticle($title);
    }
}
