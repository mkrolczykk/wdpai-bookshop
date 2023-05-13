<?php
session_start();

require_once __DIR__.'/../../common/constants/Role.php';
require_once __DIR__.'/../../repository/ShoppingCartRepository.php';

class ShoppingCartController {

    private ShoppingCartRepository $shoppingCartRepository;

    public function __construct() {
        $this->shoppingCartRepository = new ShoppingCartRepository();
    }

    public function addToShoppingCart(int $bookId, int $amount): string {

            $shoppingCartResult = $this->shoppingCartRepository->addToShoppingCart($_SESSION["id"], $bookId, $amount);

            if ($shoppingCartResult) {
                $result = array("status" => 200, "message" => "Book added!");
            } else {
                $result = array("status" => 400, "message" => "Book already present in shopping cart");
            }

            return json_encode($result);
    }

    public function removeFromShoppingCart(int $bookId): string {

        $shoppingCartResult = $this->shoppingCartRepository->removeFromShoppingCart($_SESSION["id"], $bookId);

        if($shoppingCartResult) {
            $result = array("status" => 200 , "message" => "Book Removed!");
        } else {
            $result = array("status" => 400 , "message" => "No book present in shopping cart");
        }

        return json_encode($result);
    }

    public function increaseAmountOfGivenBook(int $bookId): string {

        $increaseItemResult = $this->shoppingCartRepository->increaseAmountOfGivenBook($_SESSION["id"], $bookId);

        if($increaseItemResult) {
            $result = array("status" => 200 , "message" => "Success");
        } else {
            $result = array("status" => 400 , "message" => "Can't add more books");
        }

        return json_encode($result);
    }

    public function decreaseAmountOfGivenBook(int $bookId): string {

        $increaseItemResult = $this->shoppingCartRepository->decreaseAmountOfGivenBook($_SESSION["id"], $bookId);

        if($increaseItemResult) {
            $result = array("status" => 200 , "message" => "Success");
        } else {
            $result = array("status" => 400 , "message" => "Can't decrease number of books");
        }

        return json_encode($result);
    }

    public function getShoppingCartItemsCount(): string {

        $countResult = $this->shoppingCartRepository->getShoppingCartItemsCount($_SESSION["id"]);

        if($countResult > 0) {
            $result = array("status" => 200 , "countResult" => $countResult);
        } else {
            $result = array("status" => 400 , "countResult" => 0);
        }

        return json_encode($result);
    }
}