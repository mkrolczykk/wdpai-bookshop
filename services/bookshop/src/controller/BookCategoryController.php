<?php

require_once 'AppController.php';
require_once __DIR__ . '/../model/response/BookResp.php';
require_once __DIR__.'/../repository/BookRepository.php';

class BookCategoryController extends AppController {

    private $url;

    private BookRepository $bookRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->bookRepository = new BookRepository();
    }

    public function category()
    {
        $categoryRelatedBooks = $this->bookRepository->getCategoryRelatedBooks($_GET['type'], $_SESSION["currency"]);

        if (!$this->isPost()) {
            if (!empty($categoryRelatedBooks)) {
                return $this->render('book-category', [
                    'categoryRelatedBooks' => $categoryRelatedBooks
                ]);
            } else {
                return $this->render('book-category', ['messages' => ['No books available for category "' . $_GET['type'] . '" :(']]);
            }
        }
    }

}