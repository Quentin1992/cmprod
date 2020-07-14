<?php
class Contact{

    //properties
    private $id;
    private $name;
    private $phoneNumber;
    private $email;
    private $consent;

    function __construct($id, $name, $phoneNumber, $email, $consent){
        $this->hydrate([
            'id' => $id,
            'name' => $name,
            'phoneNumber' => $phoneNumber,
            'email' => $email,
            'consent' => $consent
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
    public function name(){ return $this->name; }
    public function phoneNumber(){ return $this->phoneNumber; }
    public function email(){ return $this->email; }
    public function consent(){ return $this->consent; }

    //setters

    public function setId($id){
        $id = (int) $id;
        if($id > 0)
            $this->id = $id;
    }

    public function setName($name){
        if(is_string($name))
            $this->name = $name;
    }

    public function setPhoneNumber($phoneNumber){
        $phoneNumber = (string) $phoneNumber;
        $this->phoneNumber = $phoneNumber;
    }

    public function setEmail($email){
        if(is_string($email))
            $this->email = $email;
    }

    public function setUrl($consent){
        if(is_string($consent))
            $this->consent = $consent;
    }

}
