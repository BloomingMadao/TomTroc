<?php

class Conversation
{
    private ?int $id;
    private int $id_user1;
    private int $id_user2;
    private int $id_book;
    private string|DateTime $dateCreation;

    public function __construct(?int $id,int $idUser1,int $idUser2,int $idBook,string|DateTime $dateCreation)
    {
        $this->setId($id);
        $this->setIdUser1($idUser1);
        $this->setIdUser2($idUser2);
        $this->setIdBook($idBook);
        $this->setCreationDate($dateCreation);
    }

    public function getId():int
    {
        return $this->id;
    }

    public function setId(int $id) :void
    {
        $this->id=$id;
    }


    public function getIdUser1() : int
    {
        return $this->id_user1;
    }

    public function setIdUser1(int $idUser1) : void
    {
        $this->id_user1=$idUser1;
    }

    public function getIdUser2() : int
    {
        return $this->id_user2;
    }

    public function setIdUser2(int $idUser2) : void 
    {

        $this->id_user2=$idUser2;
    }

    public function getIdBook() : int
    {
        return $this->id_book;
    }

    public function setIdBook(int $idBook) : void
    {
        $this->id_book=$idBook;

    }
   public function getCreationDate() : DateTime
    {
        return $this->dateCreation;
    }

    public function setCreationDate(string|DateTime $creationDate,string $format = 'Y-m-d H:i:s') : void
    {
        if(is_string($creationDate)){
            $creationDate = DateTime::createFromFormat($format,$creationDate);
        }
        $this->dateCreation=$creationDate;
    }


}