<?php

namespace App\Model;

class Names
{
    private $id;
    private $title;
    private $category;

    function __construct($id, $title, $category)
    {
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCategory()
    {
        return $this->category;
    }
}
