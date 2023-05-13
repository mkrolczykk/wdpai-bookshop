<?php
session_start();

require_once __DIR__.'/../../common/constants/Role.php';
require_once __DIR__.'/../../repository/FavoriteBooksRepository.php';

class FavoriteBooksController {

    private FavoriteBooksRepository $favoriteBooksRepository;

    public function __construct() {
        $this->favoriteBooksRepository = new FavoriteBooksRepository();
    }

    public function addToFavorites(int $bookId): string {

        $favoritesResult = $this->favoriteBooksRepository->addToFavorites($_SESSION["id"], $bookId);

        if($favoritesResult) {
            $result = array("status" => 200 , "message" => "Added to favorites!");
        } else {
            $result = array("status" => 400 , "message" => "Book already present in favorites");
        }

        return json_encode($result);
    }

    public function removeFromFavorites(int $bookId): string {

        $favoritesResult = $this->favoriteBooksRepository->removeFromFavorites($_SESSION["id"], $bookId);

        if($favoritesResult) {
            $result = array("status" => 200 , "message" => "Removed from favorites!");
        } else {
            $result = array("status" => 400 , "message" => "No book found in favorites");
        }

        return json_encode($result);
    }

    public function getFavoriteBooksCount(): string {

        $countResult = $this->favoriteBooksRepository->getFavoriteBooksCount($_SESSION["id"]);

        if($countResult > 0) {
            $result = array("status" => 200 , "countResult" => $countResult);
        } else {
            $result = array("status" => 400 , "countResult" => 0);
        }

        return json_encode($result);
    }
}