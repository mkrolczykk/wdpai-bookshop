<?php

require_once 'AppController.php';
require_once __DIR__ . '/../model/response/BookResp.php';
require_once __DIR__.'/../repository/BookRepository.php';
require_once __DIR__.'/../repository/BookOrderHistoryRepository.php';
require_once __DIR__.'/../repository/BookGenreRepository.php';

class DefaultController extends AppController {

    private $url;

    private BookRepository $bookRepository;

    private BookOrderHistoryRepository $bookOrderHistoryRepository;

    private BookGenreRepository $bookGenreRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->bookRepository = new BookRepository();
        $this->bookOrderHistoryRepository = new BookOrderHistoryRepository();
        $this->bookGenreRepository = new BookGenreRepository();
    }

    public function index()
    {

        $_SESSION["currency"] = "USD";  // temporary solution

        $totalBooks = $this->bookRepository->countBooks();
        $bookCategories = $this->bookGenreRepository->getBookGenres();
        $topSoldBooks = $this->bookOrderHistoryRepository->getTopSoldBooks(10, $_SESSION["currency"]);
        $recentlyAddedBooks = $this->bookRepository->getRecentlyAddedBooks(20, $_SESSION["currency"]);

        if (!$this->isPost()) {
            return $this->render('start-page', [
                    'totalBooks' => $totalBooks,
                    'bookCategories' => $bookCategories,
                    'topSoldBooks' => $topSoldBooks,
                    'recentlyAddedBooks' => $recentlyAddedBooks
            ]);
        }
    }
}