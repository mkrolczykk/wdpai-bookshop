<?php

require_once __DIR__.'/../../repository/BookGenreRepository.php';
require_once __DIR__.'/../../model/response/SystemUserLoginResp.php';

class BookGenreController {

    private BookGenreRepository $bookGenreRepository;

    public function __construct() {
        $this->bookGenreRepository = new BookGenreRepository();
    }

    public function getGenres(): string {

        $genresResult = $this->bookGenreRepository->getBookGenres();

        if(count($genresResult) > 0) {
            $result = array("status" => 200 , "categoriesResult" => $genresResult);
        } else {
            $result = array("status" => 200 , "message" => array());
        }

        return json_encode($result);
    }
}