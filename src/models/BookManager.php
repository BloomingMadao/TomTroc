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
                $book['resume'],
                $book['date_create'],
                $book['date_update'],
                $book['is_enable'],
                $book['url_img']);
        }
        return $books;
    }




}