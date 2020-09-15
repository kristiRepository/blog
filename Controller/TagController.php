<?php


class TagController
{

    protected $tagRequest;
    protected $tagRepository;


    public function __construct($request)
    {
        $this->tagRepository = new TagRepository();
        $this->tagRequest = new TagRequest($request);
    }

    public function create()
    {

        if ($this->tagRequest->validateCreate()) {
            return;
        };

        $this->tagRepository->create($this->tagRequest->getInput('name'));
        header('Location: /dashboard/tags');
    }
}
