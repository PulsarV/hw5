<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 03.11.15
 * Time: 0:59
 */

namespace Entity;

class Order extends AbstractEntity
{
    private $orderId;
    private $customerId;
    private $amount;
    private $orderItems;


    public function __construct($orderId, $customerId, $amount, $orderItems)
    {
        $this->orderId = $orderId;
        $this->customerId = $customerId;
        $this->amount = $amount;
        $this->orderItems = [];
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function addOrderItem($isbn, $price)
    {
        $this->orderItems[] = $isbn;
        $this->amount += $price;
    }

}