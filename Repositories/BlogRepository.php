<?php

class BlogRepository
{

    
    protected $category;
    protected $tag;
    protected $comment;
    protected $article;


    public function __construct()
    {
        $this->comment = new Comment();
        $this->category = new Category();
        $this->tag = new Tag();
        $this->article = new Article();
       
    }

    public function index(){
        $page = 1;
        $start = 0;
        $limit = 3;
        $results = "";

        if (isset($_GET['page'])) {
            if (intval($_GET['page']) > 1) {
                $start = ((intval($_GET['page']) - 1) * $limit);
                $page = (intval($_GET['page']));
            }
        }

        $response = $this->article->getAllArticles($start, $limit);
        $allarticles = $response[0];
        $articles = $response[2];
        $total = $response[3];
        $categories = $this->category->getAllCategories();
        $article_tags = $this->tag->getAllTags();


        if (isset($_GET['tag'])) {
            $res = $this->article->filterTag($_GET['tag'], 'tag_name', $start, $limit);
            $results = $res[0];
            $total = $res[1];
        }
        if (isset($_GET['category'])) {
            $res = $this->article->filterCategory($_GET['category'], 'category_name', $start, $limit);
            $results = $res[0];
            $total = $res[1];
        }

        $mydrafts = $this->article->myDrafts();

        return ['allarticles'=>$allarticles,'articles'=>$articles,'total'=>$total,'categories'=>$categories,'article_tags'=>$article_tags,'results'=>$results,'mydrafts'=>$mydrafts,'limit'=>$limit];
    }

    public function create(){
        $categories = $this->category->getAllCategories();
        $tags = $this->tag->getAllTags();
        return ['categories'=>$categories,'tags'=>$tags];
    }

    public function store($title,$summary,$body,$category,$metadata,$tags){
        
       

        $file = $this->article->resizeImage('image');
        $slug = preg_replace('/\s+/', '+', $title);

        $this->article->add([$title, $slug, $summary, $body, $file[0], $file[1], $category, 'unpublished', '0', $metadata, $_SESSION['id'], '1']);
        $articleId = $this->article->getLastId($title);
        
        foreach ($tags as $tag) {
            $this->tag->chain([$articleId[0]['id'], $tag]);
        }


    }

    public function edit($article){

        $drafts = $this->article->getDraft($article);
        $draft = $drafts[0];
        $categories = $this->category->getAllCategories();
        $tags = $this->tag->getAllTags();
        $drafttags = $this->article->getDraftTags($draft['id']);

        return ['draft'=>$draft,'categories'=>$categories,'tags'=>$tags,'drafttags'=>$drafttags];

    }

    public function show($article_slug){
 
        $articles = $this->article->getSingleArticle($article_slug);
      
        $article = $articles[0];
        $result = $this->comment->articleComments($article_slug);
         
        $comments = $result[1];
        $categories = $this->category->getAllCategories();
        $article_tags = $this->tag->getAllTags();

        return ['article'=>$article,'comments'=>$comments,'categories'=>$categories,'article_tags'=>$article_tags];


    }

    public function delete($submit,$draft_id){

        if (isset($submit)) {
            $article = $draft_id;
            $this->article->deleteDraft($article);
        }
    }

    public function draft($title,$summary,$body,$category,$metadata,$tags){

        $file = $this->article->resizeImage('image');
        $slug = preg_replace('/\s+/', '+', $title);
        $this->article->add([$title, $slug, $summary, $body, $file[0], $file[1], $category, 'unpublished', '0', $metadata, $_SESSION['id'], '0']);
        $articleId = $this->article->getLastId($title);
        foreach ($tags as $tag) {
            $this->tag->chain([$articleId[0]['id'], $tag]);
        }

    }

    public function update($title,$image1,$thumbnail1,$category,$category1,$tags,$tags1,$id1,$summary,$body,$metadata){

        $slug = preg_replace('/\s+/', '+', $title);
        if (!isset($_FILES['image']['name']) || $_FILES['image']['name'] == "") {
            $file[0] = $image1;
            $file[1] = $thumbnail1;
        } else {
            $file = $this->article->resizeImage('image');
        }

        if (is_null($category) || $category == "") {
            $category = $category1;
        } else {
            $category = $category;
        }

        if (is_null($tags) || $tags == "") {
            $_tags = $tags1;
        } else {
            $this->article->unchainTags($id1);
            $_tags = $tags;
            foreach ($_tags as $tag) {
                $this->tag->chain([$id1, $tag]);
            }
        }


        $this->article->postDraft($title, $slug, $summary, $body, $file[0], $file[1], $category, $metadata, $id1);
    }



}