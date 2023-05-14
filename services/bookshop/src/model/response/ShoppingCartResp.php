<?php

class ShoppingCartResp {

    private $bookId;

    private $bookName;

    private $price;

    private $amount;

    private $currency;

    private $total;

    public function __construct($bookId, $bookName, $price, $amount, $currency, $total)
    {
        $this->bookId = $bookId;
        $this->bookName = $bookName;
        $this->price = $price;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->total = $total;
    }

    public function getBookId()
    {
        return $this->bookId;
    }

    public function getBookName()
    {
        return $this->bookName;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getTotal()
    {
        return $this->total;
    }

}
