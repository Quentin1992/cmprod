<?php
class Review{

    //properties
    private $id;
    private $author;
    private $content;
    private $imgLocation;

    function __construct($id, $author, $content, $imgLocation){
        $this->hydrate([
            'id' => $id,
            'author' => $author,
            'content' => $content,
            'imgLocation' => $imgLocation
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
    public function content(){ return $this->content; }
    public function imgLocation(){ return $this->imgLocation; }

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

    public function setContent($content){
        if(is_string($content))
            $this->content = $content;
    }

    public function setImgLocation($imgLocation){
        if(is_string($imgLocation))
            $this->imgLocation = $imgLocation;
    }

}
