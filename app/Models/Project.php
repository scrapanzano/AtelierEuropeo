<?php

namespace App\Models;

class Project
{
    private $id;
    private $title;
    private $category;
    private $creator;
    private $creatorID;

    public function __construct($id, $title, $category, $creator, $creatorID)
    {
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
        $this->creator = $creator;
        $this->creatorID = $creatorID;
    }

    function getID() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getCategory() {
        return $this->category;
    }

    function getCreator() {
        return $this->creator;
    }

    function getCreatorID(){
        return $this->creatorID;
    }

    function setID($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->id = $title;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    function setCreator($creator) {
        $this->creator = $creator;
    }

    function setCreatorID($creatorID) {
        $this->creatorID = $creatorID;
    }

}

