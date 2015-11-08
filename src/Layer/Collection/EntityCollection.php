<?php

/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 08.11.15
 * Time: 4:35
 */

namespace Layer\Collection;

use Entity\AbstractEntity;

class EntityCollection
{
    private static $customerCollection = [];
    private static $orderCollection = [];
    private static $orderItemCollection = [];
    private static $bookCollection = [];

    public static function addEntity(AbstractEntity $entity)
    {
        $entity->setCreatedAt(GetDate());
        switch (get_class($entity)) {
            case 'Entity\Customer':
                self::$customerCollection[$entity->getCustomerId()] = $entity;
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

    public static function getEntity($entityName, $entityId)
    {
        switch ($entityName) {
            case 'Customer':
                return self::$customerCollection[$entityId];
                break;
            case 'Order':
                return self::$orderCollection[$entityId];
                break;
            case 'OrderItem':
                return self::$orderItemCollection[$entityId];
                break;
            case 'Book':
                return self::$bookCollection[$entityId];
                break;
        }
    }

    public static function updateEntity(AbstractEntity $entity)
    {
        $entity->setUpdatedAt(GetDate());
        switch (get_class($entity)) {
            case 'Entity\Customer':
                $entity->setCreatedAt(self::$customerCollection[$entity->getCustomerId()]->getCreatedAt());
                self::$customerCollection[$entity->getCustomerId()] = $entity;
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

    public static function deleteEntity($entityName, $entityId)
    {
        switch ($entityName) {
            case 'Customer':
                self::$customerCollection[$entityId]->setDeletedAt(GetDate());
                break;
            case 'Order':
                self::$orderCollection[$entityId]->setDeletedAt(GetDate());
                break;
            case 'OrderItem':
                self::$orderItemCollection[$entityId]->setDeletedAt(GetDate());
                break;
            case 'Book':
                self::$bookCollection[$entityId]->setDeletedAt(GetDate());
                break;
        }
    }
}