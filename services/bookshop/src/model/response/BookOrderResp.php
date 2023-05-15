<?php

class BookOrderResp {

    private $orderId;

    private $orderTime;

    private $total;

    private $currency;

    private $orderStatus;

    private $orderExec;

    public function __construct($orderId, $orderTime, $total, $currency, $orderStatus, $orderExec)
    {
        $this->orderId = $orderId;
        $this->orderTime = $orderTime;
        $this->total = $total;
        $this->currency = $currency;
        $this->orderStatus = $orderStatus;
        $this->orderExec = $orderExec !== " " ? $orderExec : null;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getOrderTime()
    {
        return $this->orderTime;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    public function getOrderExec()
    {
        return $this->orderExec;
    }

}
