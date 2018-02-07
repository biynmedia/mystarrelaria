<?php

namespace App\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

class ArtisteControllerProvider implements ControllerProviderInterface {

    /**
     * {@inheritDoc}
     * @see \Silex\Api\ControllerProviderInterface::connect()
     */
    public function connect(Application $app)
    {
        
        # : Créer une instance de Silex\ControllerCollection
        # : https://silex.symfony.com/api/master/Silex/ControllerCollection.html
        $controllers = $app['controllers_factory'];
        
            # Page Inscription
            $controllers
                ->match('/inscription', 'App\Controller\ArtisteController::inscriptionAction')
                ->method('GET|POST')
                ->bind('artiste_inscription');

            # Page Profil
            $controllers
                ->get('/{artiste}', 'App\Controller\ArtisteController::profilAction')
                # On retourne au controller directement l'obet artiste !
                ->convert('artiste', function($artiste) use($app) {
                    return $app['idiorm.db']->for_table('artiste')->find_one($artiste);
                })
                ->bind('artiste_profil');


        # On retourne la liste des controllers (ControllerCollection)
        return $controllers;
        
    }
}
