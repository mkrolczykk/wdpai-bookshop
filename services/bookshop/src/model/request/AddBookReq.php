<?php

class AddBookReq {

    private $title;

    private $author;

    private $summary;

    private $description;

    private $slug;

    private $genre;

    private $numPages;

    private $language;

    private $price;

    private $currency;

    private $publisher;

    public function __construct($title, $author, $summary, $description, $slug, $genre, $numPages, $language, $price, $currency, $publisher)
    {
        $this->title = trim($title);
        $this->author = trim($author);
        $this->summary = trim($summary);
        $this->description = trim($description);
        $this->slug = trim($slug);
        $this->genre = trim($genre);
        $this->numPages = $numPages;
        $this->language = trim($language);
        $this->price = $price;
        $this->currency = trim($currency);
        $this->publisher = trim($publisher);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getNumPages()
    {
        return $this->numPages;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getPublisher()
    {
        return $this->publisher;
    }

}