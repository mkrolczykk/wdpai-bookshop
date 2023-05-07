<?php

class BookGenreResp implements JsonSerializable {

    private $genreId;

    private $genre;

    private $thumbnail;

    public function __construct($genreId, $genre, $thumbnail)
    {
        $this->genreId = $genreId;
        $this->genre = $genre;
        $this->thumbnail = $thumbnail;
    }

    public function jsonSerialize()
    {
        return [
            'genreId' => $this->genreId,
            'genre' => $this->genre,
            'thumbnail' => $this->thumbnail
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

    public function getThumbnail()
    {
        return $this->thumbnail;
    }
}