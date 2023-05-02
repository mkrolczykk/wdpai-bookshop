<?php

require_once 'AppController.php';

class NewBooksController extends AppController {

    public function newBooks()
    {
        $this->render('new-books');
    }

}