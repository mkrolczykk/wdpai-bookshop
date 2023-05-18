<?php

class CurrencyResp {

    private $currencyId;

    private $currencyName;

    private $shortcut;

    public function __construct($currencyId, $currencyName, $shortcut)
    {
        $this->currencyId = $currencyId;
        $this->currencyName = $currencyName;
        $this->shortcut = $shortcut;
    }

    public function getCurrencyId()
    {
        return $this->currencyId;
    }

    public function getCurrencyName()
    {
        return $this->currencyName;
    }

    public function getShortcut()
    {
        return $this->shortcut;
    }

}
