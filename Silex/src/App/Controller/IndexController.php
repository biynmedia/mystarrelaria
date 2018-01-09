<?php
namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    /**
     * Affichage de la Page d'Accueil
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function indexAction(Application $app) {
        
        # Déclaration d'un Message
        $message = 'Mon Application Silex !';
       
        # Affichage dans la Vue
        return $app['twig']->render('index.html.twig',[
            'message'  => $message
        ]);
    }

    public function inscriptionAction(Application $app) {
        return $app['twig']->render('inscription.html.twig');
    }
    /**
     * Traitement POST du Formulaire d'Inscription
     * @param Application $app
     * @param Request $request
     */
    public function inscriptionPost(Application $app, Request $request) {
        # Vérification et la Sécurisation des données POST
        # ...
        # Connexion à la BDD
        $membre = $app['idiorm.db']->for_table('membre')->create();
        # Affectation de Valeurs
        $membre->PRENOMMEMBRE   = $request->get('PRENOMMEMBRE');
        $membre->NOMMEMBRE      = $request->get('NOMMEMBRE');
        $membre->EMAILMEMBRE    = $request->get('EMAILMEMBRE');
        $membre->MDPMEMBRE      = $app['security.default_encoder']
            ->encodePassword($request->get('MDPMEMBRE'), '');
        $membre->ROLEMEMBRE     = 'ROLE_MEMBRE';
        # On persiste en BDD
        $membre->save();
        # On envoi un email de confirmation ou de bienvenue...
        # On envoi une notification à l'administrateur
        # ...
        # On redirige l'utilisateur sur la page de connexion
        return $app->redirect('connexion.html?inscription=success');
    }

    /**
     * Affichage de la Page Connexion
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function connexionAction(Application $app, Request $request)
    {
        return $app['twig']->render('connexion.html.twig', [
            'error' => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username')
        ]);
    }

}
