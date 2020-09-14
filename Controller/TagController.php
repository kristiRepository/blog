<?php


class TagController
{

    protected $tagRequest;
    protected $tag;


    public function __construct($request)
    {
        $this->tag = new Tag();
        $this->tagRequest = new TagRequest($request);
    }

    public function create()
    {

        if ($this->tagRequest->validateCreate()) {
            return;
        };

        $this->tag->createTag($this->tagRequest->getInput('name'));
        header('Location: /dashboard/tags');
    }
}
