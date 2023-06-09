<?php

require_once 'AppController.php';
require_once __DIR__ . '/../model/response/BookResp.php';
require_once __DIR__.'/../repository/BookRepository.php';

class FindResultsController extends AppController {

    private $url;

    private $bookRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->bookRepository = new BookRepository();
    }

    public function search()
    {

        if (!$this->isPost()) {
            return $this->render('find-results', ['messages' => ['Use search bar to find a book']]);
        }

        $searchKey = $_POST['searchkey'];

        if (isset($searchKey) && !empty(trim($searchKey))) {

            $findResult = $this->bookRepository->getBooksByTitleOrAuthor($searchKey, $_SESSION["currency"]);

            if (!$findResult) {
                return $this->render('find-results', ['messages' => ['0 results found for search key "' . $searchKey . '"']]);
            }

            $this->render('find-results', ['booksResult' => $findResult]);
        } else {
            return $this->render('find-results', ['messages' => ['No search key provided. Try again']]);
        }
    }

}