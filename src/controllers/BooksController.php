<?php

class BooksController
{

    public function showHome(): void 
    {
        require('src/views/templates/home.php');
    }
}