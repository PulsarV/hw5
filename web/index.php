<?php

require __DIR__ . '/../config/autoload.php';

use Layer\Collection\EntityCollection;
use Entity\Customer;
use Entity\Order;
use Entity\OrderItem;
use Entity\Book;

function showObject($entity)
{
    $entityArr = (array)$entity;
    foreach ($entityArr as $key=>$value ) {
        if (!strpos($key, get_class($entity))) {
            $key = str_replace('Entity\Abstract', '', $key);
            if ($value) {
                $value = $value->format('Y-m-d H:i');
            };
        } else {
            $key = str_replace(get_class($entity), '', $key);
            if (is_array($value)) {
                $s = '';
                foreach ($value as $v) {
                    $s += $v . ' ';
                }
                $value = $s;
            }
        }
        echo  $key . ': ' . $value . '<br>';
    }
}

$col1 = new EntityCollection();

EntityCollection::addCustomer(new Customer(1, 'Vasya', 'Street', 'Cherkasy'));
echo 'Customer--------------------------<br>';
showObject(EntityCollection::getCustomer(1));

EntityCollection::addBook(new Book('5-8459-0046-8', 'Майкл Морган', 'Java 2. Керіництво користувача', 34.99));
echo 'Book--------------------------<br>';
showObject(EntityCollection::getBook('5-8459-0046-8'));

$order = EntityCollection::addOrder(new Order(null, 1));
echo 'Order--------------------------<br>';
showObject(EntityCollection::getOrder(1));

EntityCollection::addOrderItem(new OrderItem($order, '5-8459-0046-8', 10));
echo 'OrderItem--------------------------<br>';
showObject(EntityCollection::getOrderItem(1));

echo 'Order--------------------------<br>';
showObject(EntityCollection::getOrder(1));
