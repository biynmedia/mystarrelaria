<?php

use App\Provider\MembreProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SessionServiceProvider;

# use Silex\Provider\SessionServiceProvider;
$app->register(new SessionServiceProvider());

#use Silex\Provider\SecurityServiceProvider;
$app->register(new SecurityServiceProvider(), [
    /**
     * Ici je crée mon firewall pour l'application.
     */
    'security.firewalls' => [
        'main'  => [
            'pattern'   => '^/',
            'http'      => true,
            'anonymous' => true,
            'form'      => [
                'login_path' => '/connexion',
                'check_path' => '/connexion/login_check',
            ], # form
            'logout'    => [
                'logout_path' => '/deconnexion'
            ], # logout
            'users'     => function() use($app) {
                return new MembreProvider($app['idiorm.db']);
            }
        ] # main
    ], # security.firewalls

    'security.access_rules' => [
        ['^/admin', 'ROLE_ADMIN', 'http'],
        ['^/membre', 'ROLE_MEMBRE', 'http'],
        ['^/membre/artiste', 'ROLE_ARTISTE', 'http'],
    ], # security.access_rules

    'security.role_hierarchy' => [
        'ROLE_ARTISTE' => ['ROLE_MEMBRE'],
        'ROLE_ADMIN' => ['ROLE_ARTISTE','ROLE_MEMBRE']
    ] # security.role_hierarchy
]);

