<?php

require_once 'AppController.php';
require_once __DIR__ . '/../common/utils/AuthUtil.php';
require_once __DIR__.'/../repository/ShoppingCartRepository.php';

class UserShoppingCartController extends AppController {

    private $url;

    private ShoppingCartRepository $shoppingCartRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->shoppingCartRepository = new ShoppingCartRepository();
    }

    public function shoppingCart()
    {
        if(AuthUtil::checkIfAuthorized($_SESSION["roleId"], Role::ROLE_USER)) {

            $shoppingCartResult =
                $this->shoppingCartRepository->getUserShoppingCart($_SESSION["id"], $_SESSION["currency"]);

            $totalAmount =
                $this->shoppingCartRepository->getCartTotalAmount($_SESSION["id"], $_SESSION["currency"]);

            if (!$this->isPost()) {

                return $this->render('shopping-cart', [
                    'shoppingCartResult' => $shoppingCartResult,
                    'totalAmount' => $totalAmount
                ]);
            }
        }
        die("Wrong url!");
    }
}