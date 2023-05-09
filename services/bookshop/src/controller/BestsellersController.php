<?php

require_once 'AppController.php';
require_once __DIR__ . '/../model/response/BookResp.php';
require_once __DIR__.'/../repository/BookOrderHistoryRepository.php';

class BestsellersController extends AppController {

    private $url;

    private BookOrderHistoryRepository $bookOrderHistoryRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->bookOrderHistoryRepository = new BookOrderHistoryRepository();
    }

    public function bestsellers()
    {

        $topSoldBooks = $this->bookOrderHistoryRepository->getTopSoldBooks(40, $_SESSION["currency"]);

        if (!$this->isPost()) {
            return $this->render('bestsellers', [
                'topSoldBooks' => $topSoldBooks
            ]);
        }
    }

}