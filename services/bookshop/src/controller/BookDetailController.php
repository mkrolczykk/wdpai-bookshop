<?php

require_once 'AppController.php';
require_once __DIR__ . '/../model/response/BookResp.php';
require_once __DIR__.'/../repository/BookRepository.php';
require_once __DIR__.'/../repository/FavoriteBooksRepository.php';

class BookDetailController extends AppController {

    private $url;

    private BookRepository $bookRepository;

    private FavoriteBooksRepository $favoriteBooksRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->bookRepository = new BookRepository();
        $this->favoriteBooksRepository = new FavoriteBooksRepository();
    }

    public function bookDetail()
    {
        $bookResult =
            $this->bookRepository->getBookByTitle($_GET['bookTitle']);

        $favoriteBooksResult =
            $this->favoriteBooksRepository->getUserFavoriteBooks($_SESSION["id"], PHP_INT_MAX );

        if (!$this->isPost()) {
            if (!empty($bookResult)) {
                return $this->render('book-detail', [
                    'bookResult' => $bookResult,
                    'favoriteBooksResult' => $favoriteBooksResult
                ]);
            } else {
                return $this->render('book-detail', ['messages' => ['No book available with title "' . $_GET['bookTitle'] . '" :(']]);
            }
        }
    }
}