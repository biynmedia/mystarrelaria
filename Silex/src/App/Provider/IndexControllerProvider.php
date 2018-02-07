<?php

namespace App\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

class IndexControllerProvider implements ControllerProviderInterface {
    
    /**
     * {@inheritDoc}
     * @see \Silex\Api\ControllerProviderInterface::connect()
     */
    public function connect(Application $app)
    {
        
        # : Créer une instance de Silex\ControllerCollection
        # : https://silex.symfony.com/api/master/Silex/ControllerCollection.html
        $controllers = $app['controllers_factory'];
        
            # Page d'Accueil
            $controllers
                # On associe une Route à un Controller et une Action
                ->get('/', 'App\Controller\IndexController::indexAction')
                # En option je peux donner un nom à la route, qui servira plus tard
                # pour la créations de lien : "controller_action"
                ->bind('index_index');

        # Page Artistes
        $controllers
            ->get('/artistes', 'App\Controller\IndexController::artistesAction')
            ->bind('index_artistes');

        # Page Article
        $controllers
            ->get('/{slugarticle}_{idarticle}.html',
                'App\Controller\IndexController::articleAction')
            ->assert('idarticle', '\d+')
            ->bind('news_article');

        #Page Profil
        $controllers
            ->get('/info', 'App\Controller\IndexController::artisteInfo')
            ->bind('index_info');

            # Page Inscription
        $controllers
            ->get('/inscription', 'App\Controller\IndexController::inscriptionAction')
            ->bind('index_inscription');

            # POST Inscription
        $controllers
            ->post('/inscription', 'App\Controller\IndexController::inscriptionPost')
            ->bind('index_inscription_post');

            # Page Connexion
        $controllers
            ->get('/connexion', 'App\Controller\IndexController::connexionAction')
            ->bind('index_connexion');

            # Page Deconnexion
        $controllers
            ->get('/deconnexion', 'App\Controller\NewsController::deconnexionAction')
            ->bind('index_deconnexion');
            
        # On retourne la liste des controllers (ControllerCollection)
        return $controllers;
        
    }

}
