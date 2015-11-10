<?php

namespace Layer\Connector;


interface ConnectorInterface
{
    public static function connect($host, $port, $dbname, $user, $password);
}