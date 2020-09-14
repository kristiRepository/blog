<?php




class BlogController
{
    protected $article;
    protected $category;
    protected $tag;
    protected $comment;
    protected $articleRequest;


    public function __construct($request)
    {
        $this->comment = new Comment();
        $this->article = new Article();
        $this->category = new Category();
        $this->tag = new Tag();
        $this->articleRequest = new ArticleRequest($request);
    }

    public function index()
    {


        $page = 1;
        $start = 0;
        $limit = 3;
        $result = "";

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

        require('views/blog/blog.php');
    }

    public function create()
    {

        $categories = $this->category->getAllCategories();
        $tags = $this->tag->getAllTags();
        require('views/blog/create.php');
    }

    public function store()
    {

        $file = array();
        $category = "";
        $tags = array();


        if ($this->articleRequest->validateCreate()) {
            return;
        };
        $file = $this->article->resizeImage('image');
        $slug = preg_replace('/\s+/', '+', $this->articleRequest->getInput('title'));

        $this->article->add([$this->articleRequest->getInput('title'), $slug, $this->articleRequest->getInput('summary'), $this->articleRequest->getInput('body'), $file[0], $file[1], $this->articleRequest->getInput('category'), 'unpublished', '0', $this->articleRequest->getInput('metadata'), $_SESSION['id'], '1']);
        $articleId = $this->article->getLastId($this->articleRequest->getInput('title'));
        foreach ($this->articleRequest->getInput('tags') as $tag) {
            $this->tag->chain([$articleId[0]['id'], $tag]);
        }


        header('Location: /index');
    }

    public function update()
    {

        if ($this->articleRequest->validateCheck()) {
            return;
        };

        $slug = preg_replace('/\s+/', '+', $this->articleRequest->getInput('title'));
        if (!isset($_FILES['image']['name']) || $_FILES['image']['name'] == "") {
            $file[0] = $this->articleRequest->getInput('image1');
            $file[1] = $this->articleRequest->getInput('thumbnail1');
        } else {
            $file = $this->article->resizeImage('image');
        }

        if (is_null($this->articleRequest->getInput('category')) || $this->articleRequest->getInput('category') == "") {
            $category = $this->articleRequest->getInput('category1');
        } else {
            $category = $this->articleRequest->getInput('category');
        }

        if (is_null($this->articleRequest->getInput('tags')) || $this->articleRequest->getInput('tags') == "") {
            $tags = $this->articleRequest->getInput('tags1');
        } else {
            $this->article->unchainTags($this->articleRequest->getInput('id1'));
            $tags = $this->articleRequest->getInput('tags');
            foreach ($tags as $tag) {
                $this->tag->chain([$this->articleRequest->getInput('id1'), $tag]);
            }
        }


        $this->article->postDraft($this->articleRequest->getInput('title'), $slug, $this->articleRequest->getInput('summary'), $this->articleRequest->getInput('body'), $file[0], $file[1], $category, $this->articleRequest->getInput('metadata'), $this->articleRequest->getInput('id1'));

        header('Location: /index');
    }



    public function edit()
    {


        $drafts = $this->article->getDraft($this->articleRequest->getInput('article'));
        $draft = $drafts[0];
        $categories = $this->category->getAllCategories();
        $tags = $this->tag->getAllTags();
        $drafttags = $this->article->getDraftTags($draft['id']);



        require('views/blog/edit.php');
    }

    public function show()
    {

        $articles = $this->article->getSingleArticle($this->articleRequest->getInput('article'));
        $article = $articles[0];
        $result = $this->comment->articleComments($this->articleRequest->getInput('article'));
        $comments = $result[1];

        require('views/blog/index.php');
    }

    public function delete()
    {
        if (isset($_POST['submit'])) {
            $article = $this->articleRequest->getInput('draft_id');
            $this->article->deleteDraft($article);
        }

        header("Location: /index");
    }

    public function draft()
    {

        if ($this->articleRequest->validateCreate()) {
            return;
        };
        $file = $this->article->resizeImage('image');
        $slug = preg_replace('/\s+/', '+', $this->articleRequest->getInput('title'));
        $this->article->add([$this->articleRequest->getInput('title'), $slug, $this->articleRequest->getInput('summary'), $this->articleRequest->getInput('body'), $file[0], $file[1], $this->articleRequest->getInput('category'), 'unpublished', '0', $this->articleRequest->getInput('metadata'), $_SESSION['id'], '0']);
        $articleId = $this->article->getLastId($this->articleRequest->getInput('title'));
        foreach ($this->articleRequest->getInput('tags') as $tag) {
            $this->tag->chain([$articleId[0]['id'], $tag]);
        }

        header('Location: /index');
    }
}
