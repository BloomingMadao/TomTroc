<?php

class BooksController
{

    public function showHome(): void
    {

        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();

        $view = new View("Accueil");
        $view->render("home", ['books' => $books]);
    }

    public function addBookForm(): void
    {
        $view = new View("Ajouter livre");
        $view->render("bookForm");
    }

    public function addBook(): void
    {

        $title = Utils::request("title");
        $idUser = Utils::request("idUser");
        $author = Utils::request("author");
        $resume = Utils::request("resume");
        $isEnable = Utils::request("isEnable");
        $img = Utils::file('img');
        $imgInfo = pathinfo($img['name']);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];




        if (empty($title) || empty($author) || empty($resume)) {
            throw new Exception("Tous les champs sont obligatoire.");
        }
        if (empty($idUser)) {
            throw new Exception("Vous devez être connecté pour ajouter un livre.");
        }
        if (!isset($img) || $img['error'] !== 0 || $img['size'] > 5000000) {
            throw new Exception("Une erreur est survenu lors du téléchargemen de l'image");
        }elseif(!in_array($imgInfo['extension'],$allowedExtensions)){
            throw new Exception("l'extention du fichier n'est pas valide : 'jpg', 'jpeg', 'png', 'gif' ");
        }
        $path = 'src/img/' . basename($img['name']);
        $this->uploadImg($img,$path);

        if (is_null($isEnable)){
            $isEnable=0;
        }else{
            $isEnable=1;
        }

        $book=new Book(null,(int)$idUser,$title,$author,$resume,date("Y-m-d H:i:s"),date("Y-m-d H:i:s"),$isEnable,$path);

        $bookManager= new BookManager();
        $bookManager->addBook($book);

        Utils::redirect('userAccount');
    }

    private function uploadImg(array $file,string $url) : void 
    {
        move_uploaded_file($file['tmp_name'],$url);
    }

}
