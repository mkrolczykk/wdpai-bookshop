<?php

require_once 'AppController.php';

class BookDetailController extends AppController {

    public function bookDetail()
    {
        $this->render('book-detail');
    }

}