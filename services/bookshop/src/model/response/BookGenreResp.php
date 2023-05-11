<?php

class BookGenreResp implements JsonSerializable {

    private $genreId;

    private $genre;

    public function __construct($genreId, $genre)
    {
        $this->genreId = $genreId;
        $this->genre = $genre;
    }

    public function jsonSerialize()
    {
        return [
            'genreId' => $this->genreId,
            'genre' => $this->genre
        ];
    }

    public function getGenreId()
    {
        return $this->genreId;
    }

    public function getGenre()
    {
        return $this->genre;
    }

}