<?php

require_once __DIR__ . '/../src/model/response/BookGenreResp.php';
require_once __DIR__ . '/../src/repository/BookGenreRepository.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$bookGenreRepository = new BookGenreRepository();

if($_SERVER["REQUEST_METHOD"] == "GET") {

    $result = array();

    $genresResult = $bookGenreRepository->getBookGenres();

    if(count($genresResult) > 0) {

        $result = array("status" => 200 , "categoriesResult" => $genresResult);

    } else {
        $result = array("status" => 200 , "message" => array());
    }

    echo json_encode($result);

} else {
    echo json_encode(array("status" => 405 , "message" => 'Method not allowed'));
}