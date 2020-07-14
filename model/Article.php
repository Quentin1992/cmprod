<?php
class Article{

    //properties
    private $id;
    private $author;
    private $title;
    private $date;
    private $logoLocation;
    private $url;

    function __construct($id, $author, $title, $date, $logoLocation, $url){
        $this->hydrate([
            'id' => $id,
            'author' => $author,
            'title' => $title,
            'date' => $date,
            'logoLocation' => $logoLocation,
            'url' => $url
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
    public function author(){ return $this->author; }
    public function title(){ return $this->title; }
    public function date(){ return $this->date; }
    public function logoLocation(){ return $this->logoLocation; }
    public function url(){ return $this->url; }

    //setters

    public function setId($id){
        $id = (int) $id;
        if($id > 0)
            $this->id = $id;
    }

    public function setAuthor($author){
        if(is_string($author))
            $this->author = $author;
    }

    public function setTitle($title){
        if(is_string($title))
            $this->title = $title;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function setLogoLocation($logoLocation){
        if(is_string($logoLocation))
            $this->logoLocation = $logoLocation;
    }

    public function setUrl($url){
        if(is_string($url))
            $this->url = $url;
    }

}
