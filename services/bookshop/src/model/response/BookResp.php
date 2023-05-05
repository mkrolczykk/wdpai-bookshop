<?php

class BookResp {

    private $title;

    private $cover;

    private $authors;

    private $price;

    private $currency;

    public function __construct($title, $cover, $authors, $price, $currency)
    {
        $this->title = $title;
        $this->cover = $cover;
        $this->authors = $authors;
        $this->price = $price;
        $this->currency = $currency;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCover()
    {
        return $this->cover;
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
