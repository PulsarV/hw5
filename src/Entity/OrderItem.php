<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 03.11.15
 * Time: 1:06
 */

namespace Entity;

class OrderItem extends AbstractEntity
{
    protected $orderId;
    protected $isbn;
    protected $quantity;

    /**
     * OrderItem constructor.
     * @param $orderId
     * @param $isbn
     * @param $quantity
     */
    public function __construct($orderId, $isbn, $quantity)
    {
        $this->orderId=$orderId;
        $this->isbn = $isbn;
        $this->quantity = $quantity;
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
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param mixed $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}