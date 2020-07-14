<?php
class Project{

    //properties
    private $id;
    private $title;
    private $description;
    private $imgLocation;
    private $url;
    private $category;

    function __construct($id, $title, $description, $imgLocation, $url, $category){
        $this->hydrate([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'imgLocation' => $imgLocation,
            'url' => $url,
            'category' => $category
        ]);
    }

    public function hydrate(array $donnees){
        foreach ($donnees as $key => $value){
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    //getters
    public function id(){ return $this->id; }
    public function title(){ return $this->title; }
    public function description(){ return $this->description; }
    public function imgLocation(){ return $this->imgLocation; }
    public function url(){ return $this->url; }
    public function category(){ return $this->category; }

    //setters

    public function setId($id){
        $id = (int) $id;
        if($id > 0)
            $this->id = $id;
    }

    public function setTitle($title){
        if(is_string($title))
            $this->title = $title;
    }

    public function setDescription($description){
        if(is_string($description))
            $this->description = $description;
    }

    public function setImgLocation($imgLocation){
        if(is_string($imgLocation))
            $this->imgLocation = $imgLocation;
    }

    public function setUrl($url){
        if(is_string($url))
            $this->url = $url;
    }

    public function setCategory($category){
        if(is_string($category))
            $this->category = $category;
    }

}
