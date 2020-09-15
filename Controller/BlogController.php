<?php




class BlogController
{
    protected $article;
    protected $category;
    protected $tag;
    protected $comment;
    protected $articleRequest;
    protected $blogRepository;


    public function __construct($request)
    {
        $this->comment = new Comment();
        $this->article = new Article();
        $this->category = new Category();
        $this->tag = new Tag();
        $this->articleRequest = new ArticleRequest($request);
        $this->blogRepository=new BlogRepository();
    }

    public function index()
    {


        $data=$this->blogRepository->index();
        $allarticles=$data['allarticles'];
        $articles=$data['articles'];
        $total=$data['total'];
        $categories=$data['categories'];
        $article_tags=$data['article_tags'];
        $results=$data['results'];
        $mydrafts=$data['mydrafts'];
        $limit=$data['limit'];

        require('views/blog/blog.php');
    }

    public function create()
    {

        
        $data=$this->blogRepository->create();
        $categories=$data['categories'];
        $tags=$data['tags'];
        require('views/blog/create.php');
    }

    public function store()
    {

        if ($this->articleRequest->validateCreate()) {
            return;
        };
       
        $this->blogRepository->store($this->articleRequest->getInput('title'),$this->articleRequest->getInput('summary'),$this->articleRequest->getInput('body'),$this->articleRequest->getInput('category'),$this->articleRequest->getInput('metadata'),$this->articleRequest->getInput('tags'));
      
        header('Location: /index');
    }

    public function update()
    {

        if ($this->articleRequest->validateCheck()) {
            return;
        };

        $this->blogRepository->update($this->articleRequest->getInput('title'),$this->articleRequest->getInput('image1'),$this->articleRequest->getInput('thumbnail1'),$this->articleRequest->getInput('category'),$this->articleRequest->getInput('category1'),$this->articleRequest->getInput('tags'),$this->articleRequest->getInput('tags1'),$this->articleRequest->getInput('id1'),$this->articleRequest->getInput('summary'),$this->articleRequest->getInput('body'),$this->articleRequest->getInput('metadata'));


        header('Location: /index');
    }



    public function edit()
    {

        $data=$this->blogRepository->edit($this->articleRequest->getInput('article'));
        $draft=$data['draft'];
        $categories=$data['categories'];
        $tags=$data['tags'];
        $drafttags=$data['drafttags'];

        require('views/blog/edit.php');
    }

    public function show()
    {
        
        $data=$this->blogRepository->show($this->articleRequest->getInput('article'));
        $article=$data['article'];
        $comments=$data['comments'];
        $categories=$data['categories'];
        $article_tags=$data['article_tags'];


        require('views/blog/index.php');
    }

    public function delete()
    {
        $this->blogRepository->delete($_POST['submit'], $this->articleRequest->getInput('draft_id'));
        

        header("Location: /index");
    }

    public function draft()
    {

        if ($this->articleRequest->validateCreate()) {
            return;
        };

        $this->blogRepository->draft($this->articleRequest->getInput('title'),$this->articleRequest->getInput('summary'),$this->articleRequest->getInput('body'),$this->articleRequest->getInput('category'),$this->articleRequest->getInput('metadata'),$this->articleRequest->getInput('tags'));
       
        header('Location: /index');
    }
}
