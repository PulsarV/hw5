<?php

require __DIR__ . '/../config/autoload.php';

use Layer\Collection\EntityCollection;
use Entity\Customer;


EntityCollection::addEntity(new Customer(1, 'Vasya', 'Street', 'Cherkasy', []));

print_r((array)EntityCollection::getEntity('Customer', 1));

echo '<br>';

EntityCollection::updateEntity(new Customer(1, 'Vova', 'Street1', 'Cherkasy', []));

print_r((array)EntityCollection::getEntity('Customer', 1));

echo '<br>';

EntityCollection::deleteEntity('Customer', 1);

print_r((array)EntityCollection::getEntity('Customer', 1));