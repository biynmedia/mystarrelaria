<?php
namespace App\Controller;

use Silex\Application;

class ArtisteController
{
    /**
     * Affichage de la Page Inscription
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function inscriptionAction(Application $app) {
       
        # Création du Formulaire

        # Traitement du Formulaire
       
        # Affichage dans la Vue
        return $app['twig']->render('membre/artiste/inscription.html.twig');
    }

    /**
     * Affichage de la Page Inscription
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function profilAction(Application $app) {
       
        # Création du Formulaire

        # Traitement du Formulaire
       
        # Affichage dans la Vue
        return $app['twig']->render('membre/artiste/profil.html.twig');
    }

}
