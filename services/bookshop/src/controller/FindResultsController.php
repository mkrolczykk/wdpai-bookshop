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

    public function searchResults()
    {

        if (!$this->isPost()) {
            return $this->render('find-results');
        }

        $searchKey = $_POST['searchkey'];

        $findResult = $this->bookRepository->getBooksByTitleOrAuthor($searchKey);

        if (!$findResult) {
            return $this->render('find-results', ['messages' => ['No books found for search key: "' . $searchKey . '" :(']]);
        }

        $this->render('find-results', ['findResult' => $findResult]);
    }

}