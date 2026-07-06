<?php

class BookManager
{
    private $db;

    public function __construct()
    {
        $this->db= DBManager::getInstance();
    }

    public function getAllBooks(): array
    {
        $sql="SELECT * FROM books WHERE is_enable=1 order by date_create ASC";

        $result = $this->db->query($sql);
        $books = [];

        while($book=$result->fetch()){
            $books[] = new Book(
                $book['id'],
                $book['id_user'],
                $book['title'],
                $book['author'],
                $book['resume'],
                $book['date_create'],
                $book['date_update'],
                $book['is_enable'],
                $book['url_img']);
        }
        return $books;
    }

    public function getAllBooksByUserId(int $idUser) : array
    {
        $sql="SELECT * FROM books WHERE id_user = :id_user ORDER BY date_create ASC";
        $result = $this->db->query($sql,[
            'id_user'=>$idUser
        ]);
        $books = [];

        while($book=$result->fetch()){
            $books[] = new Book(
                $book['id'],
                $book['id_user'],
                $book['title'],
                $book['author'],
                $book['resume'],
                $book['date_create'],
                $book['date_update'],
                $book['is_enable'],
                $book['url_img']);
        }
        return $books;
    }

    public function getBookByIds(int $id, int $idUser) : ?Book
    {
        $sql="SELECT * FROM books WHERE id = :id AND id_user = :id_user";
        $result = $this->db->query($sql,[
            'id'=>$id,
            'id_user'=>$idUser,
        ]);
        $book = $result->fetch();
        if($book){
            $aBook = new Book($book['id'],$book['id_user'],$book['title'],$book['author'],$book['resume'],$book['date_create'],$book['date_update'],$book['is_enable'],$book['url_img']);
            return $aBook;
        }
        return null;
    }

    public function addBook(Book $book) : void
    {
        $sql = "INSERT INTO books(id_user,title,author,resume,date_create,date_update,is_enable,url_img) VALUES (:id_user, :title, :author, :resume, :date_create, :date_update, :is_enable, :url_img )";
        $this->db->query($sql,[
            'id_user'=>$book->getIdUser(),
            'title'=>$book->getTitle(),
            'author'=>$book->getAuthor(),
            'resume'=>$book->getResume(),
            'date_create'=>$book->getCreationDate()->format('Y-m-d H:i:s'),
            'date_update'=>$book->getUpdateDate()->format('Y-m-d H:i:s'),
            'is_enable'=>$book->getIsEnable(),
            'url_img'=>$book->getUrlImg(),
        ]);

    }


    public function updateBook (Book $book) : void
    {
        $sql = "UPDATE books SET title = :title, author = :author, resume = :resume,date_update= :date_update, is_enable = :is_enable, url_img = :url_img WHERE id = :id AND id_user = :id_user";
        $this->db->query($sql,[
            'id'=> $book->getId(),
            'id_user'=>$book->getIdUser(),
            'title'=>$book->getTitle(),
            'author'=>$book->getAuthor(),
            'resume'=>$book->getResume(),
            'date_update'=>$book->getUpdateDate()->format('Y-m-d H:i:s'),
            'is_enable'=>$book->getIsEnable(),
            'url_img'=>$book->getUrlImg(),
        ]);
    }

    public function deleteBook(int $id,int $idUser) : void 
    {
        $sql="DELETE FROM books WHERE id = :id AND id_user = :id_user";
        $this->db->query($sql,[
            'id'=>$id,
            'id_user'=>$idUser,
        ]);
    }




}