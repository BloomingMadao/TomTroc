<?php

class Message
{
    private ?int $id;
    private int $idConversation;
    private int $idSender;
    private string $message;
    private string|DateTime $dateCreate;
    private int|bool $isRead;


    public function __construct(?int $id,int $idConversation,int $idSender,string $message,string|DateTime $dateCreate, int|bool $isRead)
    {
        $this->setId($id);
        $this->setIdConversation($idConversation);
        $this->setIdSender($idSender);
        $this->setMessage($message);
        $this->setDateCreate($dateCreate);
        $this->setIsRead($isRead);
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

    public function getIsRead():bool
    {
        return $this->isRead;
    }

    public function setIsRead(int|bool $isRead) :void 
    {
        if (is_int($isRead)&&$isRead==0){
            $this->isRead=false;
        }elseif(is_int($isRead)&&$isRead==1){
            $this->isRead=true;
        }elseif(is_bool($isRead)&&$isRead==true){
            $this->isRead=1;
        }elseif(is_bool($isRead)&&$isRead==false){
            $this->isRead=0;
        }else{
            throw new Exception('Le message n\'a pas été reconnue',-1);
        }
    }


}