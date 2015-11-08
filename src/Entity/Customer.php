<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 03.11.15
 * Time: 0:55
 */

namespace Entity;

class Customer extends AbstractEntity
{
    private $customerId;
    private $name;
    private $address;
    private $city;
    private $orders;

    public function __construct($customerId, $name, $address, $city, $orders)
    {
        $this->customerId = $customerId;
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->orders = $orders;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    public function addOrder($orderId)
    {
        $this->orders[] = $orderId;
    }
}