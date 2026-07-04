<?php

class BooksController
{

    public function showHome(): void 
    {
        $view=new View("Accueil");
        $view->render("home");
    }
}