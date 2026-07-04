<?php

class BooksController
{

    public function showHome(): void 
    {

        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();

        $view=new View("Accueil");
        $view->render("home",['books'=>$books]);
    }
}