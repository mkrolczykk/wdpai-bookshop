<?php

class BookDetailResp {

    private $bookId;

    private $title;

    private $authors;

    private $category;

    private $summary;

    private $description;

    private $price;

    private $currency;

    private $numPages;

    private $languages;

    private $addedAt;

    public function __construct($bookId, $title, $authors, $category, $summary, $description, $price, $currency, $numPages, $languages, $addedAt)
    {
        $this->bookId = $bookId;
        $this->title = $title;
        $this->authors = $authors;
        $this->category = $category;
        $this->summary = $summary;
        $this->description = $description;
        $this->price = $price;
        $this->currency = $currency;
        $this->numPages = $numPages;
        $this->languages = $languages;
        $this->addedAt = $addedAt;
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

    public function getCategory()
    {
        return $this->category;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getNumPages()
    {
        return $this->numPages;
    }

    public function getLanguages()
    {
        return $this->languages;
    }

    public function getAddedAt()
    {
        return $this->addedAt;
    }

}
