<?php

include 'database.connexion.php';

use Idiorm\Silex\Provider\IdiormServiceProvider;

#1 : Doctrine DBAL
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => 'relaria',
        'user'      => 'root',
        'password'  => ''
    ),
));

#2 : Idiorm ORM
$app->register(new IdiormServiceProvider(), array(
    'idiorm.db.options' => array(
        'connection_string' => 'mysql:host='.DBHOST.';dbname='.DBNAME,
        'username' => DBUSERNAME,
        'password' => DBPASSWORD,
        'id_column_overrides' => array(
            'genre'     => 'IDGENRE',
            'article'   => 'IDARTICLE',
            'artiste'           => 'ALIASARTISTE',
            'album'             => 'IDALBUM',
            'view_discographie' => 'IDALBUM'
        )
    )
));