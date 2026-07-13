<?php

class Message
{
    private ?int $id;
    private int $idConversation;
    private int $idSender;
    private string $message;
    private string|DateTime $dateCreate;


    public function __construct(?int $id,int $idConversation,int $idSender,string $message,string|DateTime $dateCreate)
    {
        $this->setId($id);
        $this->setIdConversation($idConversation);
        $this->setIdSender($idSender);
        $this->setMessage($message);
        $this->setDateCreate($dateCreate);
    }

    public function getId():?int
    {
        return $this->id;
    }

    public function setId(?int $id):void
    {
        $this->id=$id;
    }

    public function getIdConversation():int
    {
        return $this->idConversation;
    }

    public function setIdConversation(int $idConversation):void
    {
        $this->idConversation=$idConversation;
    }

    public function getIdSender():int
    {
        return $this->idSender;
    }

    public function setIdSender(int $idSender):void
    {
        $this->idSender=$idSender;
    }

    public function getMessage():string
    {
        return $this->message;
    }

    public function setMessage(string $message) :void 
    {
        $this->message=$message;
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