<?php

require_once 'AppController.php';

class BookCategoryController extends AppController {

    public function category()
    {
        $this->render('book-category');
    }

}