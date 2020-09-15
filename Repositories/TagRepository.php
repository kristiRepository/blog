<?php

class TagRepository
{


   
    protected $tag;


    public function __construct()
    {
        $this->tag = new Tag();
       
    }

    public function create($name){
        $this->tag->createTag($name);
    }



}