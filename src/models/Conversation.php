<?php

class Conversation
{
    private ?int $id;
    private int $idUser1;
    private int $idUser2;
    private string|DateTime $dateCreate;


    public function __construct(?int $id,int $idUser1, int $idUser2, string|DateTime $dateCreate)
    {
        $this->setId($id);
        $this->setIdUser1($idUser1);
        $this->setIdUser2($idUser2);
        $this->setDateCreate($dateCreate);
    }
    public function getId():int
    {
        return $this->id;
    }

    public function setId(?int $id):void
    {   
        $this->id=$id;
    }

    public function getIdUser1() : int
    {
        return $this->idUser1;
    }

    public function setIdUser1(int $idUser1) : void
    {
        $this->idUser1=$idUser1;
    }

    public function getIdUser2() : int
    {
        return $this->idUser2;
    }

    /**
     * Retourne l'id de l'"autre" participant de la conversation,
     * par rapport à l'utilisateur actuellement connecté.
     */
    public function getOtherUserId(int $currentUserId) : int
    {
        return $this->idUser1 === $currentUserId ? $this->idUser2 : $this->idUser1;
    }

    public function setIdUser2(int $idUser2) : void
    {
        $this->idUser2=$idUser2;
    }

        public function getDateCreate() : DateTime
    {
        return $this->dateCreate;
    }

    public function setDateCreate(string|DateTime $creationDate,string $format = 'Y-m-d H:i:s') : void
    {
        if(is_string($creationDate)){
            $creationDate = DateTime::createFromFormat($format,$creationDate);
        }
        $this->dateCreate=$creationDate;
    }


}