<?php

namespace App\Provider;


use Silex\Api\ControllerProviderInterface;
use Silex\Application;

class ArticleControllerProvider implements ControllerProviderInterface
{

    public function connect(Application $app)
    {

        # Recuperation instance de Silex\ControllerCollection
        $controllers = $app['controllers_factory'];

        # Ajouter un article en BDD
        $controllers
            ->match('/article/ajouter',
                'App\Controller\ArticleController::addarticleAction')
            ->method('GET|POST')
            ->bind('article_addarticle');

        return $controllers;
    }

}