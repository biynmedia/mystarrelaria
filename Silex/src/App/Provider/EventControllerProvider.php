<?php

namespace App\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

class EventControllerProvider implements ControllerProviderInterface
{

    public function connect(Application $app)
    {
        # Récupérer l'instance de Silex\ControllerCollection
        # https://silex.symfony.com/api/master/Silex/ControllerCollection.html
        $controllers = $app['controllers_factory'];
        # Ajouter un Article en BDD
        $controllers
            ->match('/ajouter',
                'App\Controller\EventController::addeventAction')
            ->method('GET|POST')
            ->bind('evenement_addevent');
        return $controllers;
    }

}