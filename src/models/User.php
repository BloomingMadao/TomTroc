<?php

class User 
{
    private ?int $id;
    private string $username;
    private ?string $password;
    private ?string $mail;
    private string $urlImg;

    public function __construct (?int $id, string $username,?string $mail, ?string $password,string $urlImg)
    {
        $this->setId($id);
        $this->setUsername($username);
        $this->setMail($mail);
        $this->setPassword($password);
    }

    public function getId() :int
    {
        return $this->id;
    }

    public function setId(?int $id) : void 
    {
        $this->id=$id;
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    public function setUsername(string $username) : void 
    {
        $this->username=$username;
    }

    public function getPassword() : ?string 
    {
        return $this->password;
    }

    public function setPassword(?string $password) : void
    {
        $this->password=$password;
    }

    public function getMail() : ?string  
    {
        return $this->mail;
    }

    public function setMail(?string $mail) : void 
    {
        $this->mail=$mail;
    }

    public function getUrlImg () : string 
    {
        return $this->urlImg;
    }
    
    public function setUrlImg(string $urlImg) : void 
    {
        $this->urlImg=$urlImg;
    }

}