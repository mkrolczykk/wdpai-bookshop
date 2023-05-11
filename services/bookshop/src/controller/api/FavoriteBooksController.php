<?php

require_once __DIR__.'/../../repository/FavoriteBooksRepository.php';

class FavoriteBooksController {

    private FavoriteBooksRepository $favoriteBooksRepository;

    public function __construct() {
        $this->favoriteBooksRepository = new FavoriteBooksRepository();
    }

    public function addToFavorites(int $bookId): string {

        $favoritesResult = $this->favoriteBooksRepository->addToFavorites($_SESSION["id"], $bookId);

        if($favoritesResult) {
            $result = array("status" => 200 , "message" => "Added to favourites!");
        } else {
            $result = array("status" => 400 , "message" => "Book already present in favourites");
        }

        return json_encode($result);
    }

    public function removeFromFavorites(int $bookId): string {

        $favoritesResult = $this->favoriteBooksRepository->removeFromFavorites($_SESSION["id"], $bookId);

        if($favoritesResult) {
            $result = array("status" => 200 , "message" => "Removed from favourites!");
        } else {
            $result = array("status" => 400 , "message" => "No book found in favourites");
        }

        return json_encode($result);
    }
}