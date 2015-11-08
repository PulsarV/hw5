<?php

/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 08.11.15
 * Time: 4:35
 */

namespace Layer\Collection;

use Entity\AbstractEntity;
use Entity\Customer;
use Entity\Order;
use Entity\OrderItem;
use Entity\Book;
use \DateTime;

class EntityCollection
{
    private static $customerCollection = [];
    private static $orderCollection = [];
    private static $orderItemCollection = [];
    private static $bookCollection = [];

    public function __construct()
    {
        self::$customerCollection[] = 0;
        self::$orderCollection[] = 0;
        self::$orderItemCollection[] = 0;
        self::$bookCollection[] = 0;
    }

    public static function addCustomer(Customer $customer)
    {
        $customer->setCreatedAt(new DateTime());

        if (!$customer->getCustomerId()) {
            self::$customerCollection[0] += 1;
            $customer->setCustomerId(self::$customerCollection[0]);
        } elseif ($customer->getCustomerId() > self::$customerCollection[0]) {
            self::$customerCollection[0] = $customer->getCustomerId();
        } else {
            if (self::$customerCollection[$customer->getCustomerId()]) {
                return false;
            }
        }

        self::$customerCollection[self::$customerCollection[0]] = $customer;

        return self::$customerCollection[0];
    }

    public static function addOrder(Order $order)
    {
        $order->setCreatedAt(new DateTime());

        if (!self::$customerCollection[$order->getCustomerId()])
        {
            return false;
        }

        $oldId = self::$orderCollection[0];

        if (!$order->getOrderId()) {
            self::$orderCollection[0] += 1;
            $order->setOrderId(self::$orderCollection[0]);
        } elseif ($order->getOrderId() > self::$orderCollection[0]) {
            self::$orderCollection[0] = $order->getOrderId();
        } else {
            if (self::$orderCollection[$order->getOrderId()]) {
                return false;
            }
        }

        foreach (self::$customerCollection[$order->getCustomerId()]->getOrders() as $o) {
            if ($o == $order->getOrderId()) {
                self::$orderCollection[0] = $oldId;
                return false;
            }
        }

        self::$orderCollection[self::$orderCollection[0]] = $order;
        self::$customerCollection[$order->getCustomerId()]->addOrder(self::$orderCollection[0]);
        self::$customerCollection[$order->getCustomerId()]->setUpdatedAt(new DateTime());

        return self::$orderCollection[0];
    }

    public static function addOrderItem(OrderItem $orderItem)
    {
        if (!$orderItem->getOrderId() or !$orderItem->getIsbn()) {
            return false;
        }


        if (!self::$orderCollection[$orderItem->getOrderId()]) {
            return false;
        }

        $isError = true;
        foreach (self::$bookCollection as $key=>$value) {
            if ($key == $orderItem->getIsbn()) {
                $isError = false;
                break;
            }
        }
        if ($isError) {
            return false;
        }

        for ($i = 0; $i < self::$orderItemCollection[0]; $i++) {
            if (self::$orderItemCollection[$i + 1]->getOrderId() == $orderItem->getOrderId()
                and self::$orderItemCollection[$i + 1]->getIsbn() == $orderItem->getIsbn()) {
                return null; //Додати Update
            }
        }

        $orderItem->setCreatedAt(new DateTime());
        self::$orderItemCollection[0] += 1;
        self::$orderItemCollection[self::$orderCollection[0]] = $orderItem;
        self::$orderCollection[$orderItem->getOrderId()]->addOrderItem(self::$orderItemCollection[0],
            $orderItem->getQuantity() * self::$bookCollection[$orderItem->getIsbn()]->getPrice());
        self::$orderCollection[$orderItem->getOrderId()]->setUpdatedAt(new DateTime());

        return $orderItem->getOrderId();
    }

    public static function addBook(Book $book)
    {
        $book->setCreatedAt(new DateTime());

        if (array_key_exists($book->getIsbn(), self::$bookCollection)) {
                return false;
        }

        self::$bookCollection[$book->getIsbn()] = $book;

        return $book->getIsbn();
    }

    public static function getCustomer($customerId)
    {
        return self::$customerCollection[$customerId];
    }

    public static function getOrder($orderId)
    {
        return self::$orderCollection[$orderId];
    }

    public static function getOrderItem($orderItemId)
    {
        return self::$orderItemCollection[$orderItemId];
    }

    public static function getBook($bookId)
    {
        return self::$bookCollection[$bookId];
    }

    public static function updateCustomer(Customer $customer)
    {
        $customer->setUpdatedAt(new DateTime());
        self::$customerCollection[$customer->getCustomerId()] = $customer;
    }

    public static function updateOrder(Order $order)
    {
        $order->setUpdatedAt(new DateTime());
        self::$orderCollection[$order->getOrderId()] = $order;
    }

    public static function updateOrderItem(OrderItem $orderItem)
    {
        $orderItem->setUpdatedAt(new DateTime());
        self::$orderItemCollection[$orderItem->getCustomerId()] = $orderItem;
    }

    public static function updateBook(Book $book)
    {
        $book->setUpdatedAt(new DateTime());
        self::$bookCollection[$book->getBookIsbn()] = $book;
    }

    public static function updateEntity(AbstractEntity $entity)
    {
        $entity->setUpdatedAt(new DateTime());
        switch (get_class($entity)) {
            case 'Entity\Customer':

                break;
            case 'Entity\Order':
                self::$orderCollection[$entity->getOrderId()] = $entity;
                break;
            case 'Entity\OrderItem':
                self::$orderItemCollection[$entity->getOrderId()] = $entity;
                break;
            case 'Entity\Book':
                self::$bookCollection[$entity->getIsbn()] = $entity;
                break;
        }
    }

    public static function deleteCustomer($customerId)
    {
        self::$customerCollection[$customerId]->setDeletedAt(new DateTime());
        return $customerId;
    }

    public static function deleteOrder($orderId)
    {
        self::$orderCollection[$orderId]->setDeletedAt(new DateTime());
        return $orderId;
    }

    public static function deleteOrderItem($orderItemId)
    {
        self::$orderItemCollection[$orderItemId]->setDeletedAt(new DateTime());
        return $orderItemId;
    }

    public static function deleteBook($bookId)
    {
        self::$bookCollection[$bookId]->setDeletedAt(new DateTime());
        return $bookId;
    }
}