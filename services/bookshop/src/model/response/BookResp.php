<?php

class BookResp {

    private $bookId;

    private $title;

    private $authors;

    private $price;

    private $currency;

    public function __construct($bookId, $title, $authors, $price, $currency)
    {
        $this->bookId = $bookId;
        $this->title = $title;
        $this->authors = $authors;
        $this->price = $price;
        $this->currency = $currency;
    }

    public function getBookId()
    {
        return $this->bookId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthors()
    {
        return $this->authors;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

}
