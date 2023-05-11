<?php

require_once 'Repository.php';
require_once __DIR__ . '/../model/response/BookGenreResp.php';

class BookGenreRepository extends Repository {

    public function getBookGenres(): array {

        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT 
                genre_id AS genreId,
                genre
            FROM book_genre
        ');

        $stmt->execute();
        $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($genres as $genre) {
            $result[] = new BookGenreResp(
                $genre['genreId'],
                $genre['genre']
            );
        }

        return $result;
    }

}