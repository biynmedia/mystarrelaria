<?php

use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SessionServiceProvider;

# use Silex\Provider\SessionServiceProvider;
$app->register(new SessionServiceProvider());

#use Silex\Provider\SecurityServiceProvider;
$app->register(new SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'main' => array(
            'pattern'   => '^/',
            'http'      => true,
            'anonymous' => true,
            'form'      => [
                'login_path' => '/connexion.html',
                'check_path' => '/connexion.html/login_check',
            ],
            'logout'    => [
                'logout_path' => '/deconnexion.html'
            ],
            )
        ),
        'security.access_rules' => array(),
        'security.role_hierarchy' => array()
    )
);

