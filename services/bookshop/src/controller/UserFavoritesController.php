<?php

require_once 'AppController.php';
require_once __DIR__ . '/../common/utils/AuthUtil.php';
require_once __DIR__.'/../repository/FavoriteBooksRepository.php';

class UserFavoritesController extends AppController {

    private $url;

    private FavoriteBooksRepository $favoriteBookRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->favoriteBookRepository = new FavoriteBooksRepository();
    }

    public function myFavorites()
    {
        if(AuthUtil::checkIfAuthorized($_SESSION["roleId"], Role::ROLE_USER)) {

            $userFavoriteBooks = $this->favoriteBookRepository->getUserFavoriteBooks($_SESSION["id"], PHP_INT_MAX);

            if (!$this->isPost()) {

                return $this->render('user-favorite', [
                    'userFavoriteBooks' => $userFavoriteBooks
                ]);
            }
        }
        die("Wrong url!");
    }
}