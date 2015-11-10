<?php

require __DIR__ . '/../config/autoload.php';

use Layer\Collection\EntityCollection;
use Layer\Collection\InitCollection;
use Entity\Customer;
use Entity\Order;
use Entity\OrderItem;
use Entity\Book;
use Layer\Manager\Manager;

//InitCollection::init($tables);

$controller = new MainController();
$controller->run();

/*function showObject($entity)
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

/*
echo 'Customer--------------------------<br>';
showObject(EntityCollection::getCustomer(1));

echo 'Book--------------------------<br>';
showObject(EntityCollection::getBook('5-8459-0046-8'));

echo 'Order--------------------------<br>';
showObject(EntityCollection::getOrder(1));

echo 'OrderItem--------------------------<br>';
showObject(EntityCollection::getOrderItem(1, '5-8459-0046-8'));

echo 'Order--------------------------<br>';
showObject(EntityCollection::getOrder(1));*/
/*
$a = new Manager();
$x = $a->findAll('Customer');
echo $x[0]->getName();*/