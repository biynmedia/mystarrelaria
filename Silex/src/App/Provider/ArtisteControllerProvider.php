<?php

namespace App\Provider;

use Silex\Api\ControllerProviderInterface;

class ArtisteControllerProvider implements ControllerProviderInterface {
    
    /**
     * {@inheritDoc}
     * @see \Silex\Api\ControllerProviderInterface::connect()
     */
    public function connect(\Silex\Application $app)
    {
        
        # : Créer une instance de Silex\ControllerCollection
        # : https://silex.symfony.com/api/master/Silex/ControllerCollection.html
        $controllers = $app['controllers_factory'];
        
            # Page Inscription
            $controllers
                ->get('/inscription', 'App\Controller\ArtisteController::inscriptionAction')
                ->bind('artiste_inscription');

            # Page Profil
            $controllers
            ->get('/profil', 'App\Controller\ArtisteController::profilAction')
            ->bind('artiste_profil');

        # On retourne la liste des controllers (ControllerCollection)
        return $controllers;
        
    }
}
