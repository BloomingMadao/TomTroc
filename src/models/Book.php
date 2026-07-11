<?php

class Book
{
    private ?int $id = -1;
    private int $idUser;
    private string $title;
    private string $author;
    private string $resume;
    private ?DateTime $creationDate;
    private ?DateTime $updateDate;
    private ?bool $isEnable;
    private string $urlImg;
    private ?string $username;



    public function __construct(?int $id,int $idUser,string $title,string $author,string $resume, string|DateTime $creationDate, string|DateTime $updateDate,bool|int $isEnable,string $urlImg,?string $username)
    {
        $this->setId($id);
        $this->setIdUser($idUser);
        $this->setTitle($title);
        $this->setAuthor($author);
        $this->setResume($resume);
        $this->setCreationDate($creationDate);
        $this->setUpdateDate($updateDate);
        $this->setIsEnable($isEnable);
        $this->setUrlImg($urlImg);
        $this->setUsername($username);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIdUser() : int 
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser) : void 
    {
        $this->idUser=$idUser;
    }

    public function getTitle() : string 
    {
        return $this->title;
    }

    public function setTitle(string $title) : void
    {
        $this->title=$title;
    }

    public function getAuthor() : string 
    {
        return $this->author;
    }
    
    public function setAuthor(string $author) : void
    {
        $this->author=$author;
    }

    public function getResume(int $length = -1):string
    {
            if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $content = mb_substr($this->resume, 0, $length);
            if (strlen($this->resume) > $length) {
                $content .= "...";
            }
            return $content;
        }
        return $this->resume;
    }

    public function setResume(string $resume) : void
    {
        
        $this->resume=$resume;
    } 
    
    public function getCreationDate() : DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(string|DateTime $creationDate,string $format = 'Y-m-d H:i:s') : void
    {
        if(is_string($creationDate)){
            $creationDate = DateTime::createFromFormat($format,$creationDate);
        }
        $this->creationDate=$creationDate;
    }

    public function getUpdateDate() : DateTime
    {
        return $this->updateDate;
    }

    public function setUpdateDate(string|DateTime $updateDate,string $format = 'Y-m-d H:i:s') : void
    {
        if(is_string($updateDate)){
            $updateDate = DateTime::createFromFormat($format,$updateDate);
        }
        $this->updateDate=$updateDate;
    }


    public function getIsEnable():bool
    {
        return $this->isEnable;
    }

    public function setIsEnable(int|bool $isEnable) :void 
    {
        if (is_int($isEnable) && $isEnable===1) {
            $isEnable=true;
        }elseif(is_int($isEnable) && $isEnable===0){
            $isEnable=false;
        }
        $this->isEnable=$isEnable;
    }

    public function getUrlImg():string
    {
        return $this->urlImg;
    }

    public function setUrlImg(string $urlImg):void
    {
        $this->urlImg=$urlImg;
    }

    public function getUsername():string
    {
        return $this->username;
    }

    public function setUsername(?string $username) :void
    {
        $this->username=$username;
    }
}
