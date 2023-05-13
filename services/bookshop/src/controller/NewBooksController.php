<?php

require_once 'AppController.php';
require_once __DIR__ . '/../model/response/BookResp.php';
require_once __DIR__.'/../repository/BookRepository.php';

class NewBooksController extends AppController {

    private $url;

    private BookRepository $bookRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->bookRepository = new BookRepository();
    }

    public function newBooks()
    {

        $recentlyAddedBooks = $this->bookRepository->getRecentlyAddedBooks(40, $_SESSION["authenticated"] ? $_SESSION["currency"] : "USD");

        if (!$this->isPost()) {
            return $this->render('new-books', [
                'recentlyAddedBooks' => $recentlyAddedBooks
            ]);
        }

    }


}