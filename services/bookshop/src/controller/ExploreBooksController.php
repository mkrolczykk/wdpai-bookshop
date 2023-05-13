<?php

require_once 'AppController.php';
require_once __DIR__ . '/../common/utils/AuthUtil.php';
require_once __DIR__.'/../repository/BookGenreRepository.php';

class ExploreBooksController extends AppController {

    private $url;

    private BookGenreRepository $bookGenreRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->bookGenreRepository = new BookGenreRepository();
    }

    public function explore()
    {
        if(AuthUtil::checkIfAuthorized($_SESSION["roleId"], Role::ROLE_USER)) {

            $bookCategories = $this->bookGenreRepository->getBookGenres();

            if (!$this->isPost()) {

                if (!empty($bookCategories)) {
                    return $this->render('explore-books', [
                        'bookCategories' => $bookCategories
                    ]);
                } else {
                    return $this->render('explore-books', ['messages' => ['No categories available']]);
                }
            }
        }
        die("Wrong url!");
    }
}