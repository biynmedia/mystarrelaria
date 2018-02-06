<?php

include 'database.connexion.php';

use Idiorm\Silex\Provider\IdiormServiceProvider;


#1 : Doctrine DBAL
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => 'pdo_mysql',
        'host'      => DBHOST,
        'dbname'    => DBNAME,
        'user'      => DBUSERNAME,
        'password'  => DBPASSWORD
    ),
));

#2 : Idiorm ORM
$app->register(new IdiormServiceProvider(), array(
    'idiorm.db.options' => array(
        'connection_string' => 'mysql:host='.DBHOST.';dbname='.DBNAME,
        'username' => DBUSERNAME,
        'password' => DBPASSWORD,
        'id_column_overrides' => array()
    )
));