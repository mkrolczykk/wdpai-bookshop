<?php

require_once 'AppController.php';
require_once __DIR__ . '/../model/response/BookResp.php';
require_once __DIR__.'/../repository/BookRepository.php';

class BookDetailController extends AppController {

    private $url;

    private BookRepository $bookRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->bookRepository = new BookRepository();
    }

    public function bookDetail()
    {
        $bookResult =
            $this->bookRepository->getBookByTitle($_GET['bookTitle']);

        if (!$this->isPost()) {
            if (!empty($bookResult)) {
                return $this->render('book-detail', [
                    'bookResult' => $bookResult
                ]);
            } else {
                return $this->render('book-detail', ['messages' => ['No book available with title "' . $_GET['bookTitle'] . '" :(']]);
            }
        }
    }
}