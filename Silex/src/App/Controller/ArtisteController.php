<?php
namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class ArtisteController
{
    /**
     * Affichage de la Page Inscription
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function inscriptionAction(Application $app, Request $request) {
        # Récupérer la liste des genres

        $genres = function() use($app) {

            # Récupération des Genres dans la BDD
            $genres = $app['idiorm.db']->for_table('genre')
                ->find_result_set();
            # On formate l'affichage pour le champ select (ChoiceType)
            $array = [];
            foreach ($genres as $genre):
                $array[$genre->NOMGENRE] = $genre->IDGENRE;
            endforeach;
            # On retourne le tableau formaté.
            return $array   ;
        };


        # Connexion a la BDD
        $artiste = $app['idiorm.db']->for_table('artiste')->create();

        # Affectation des valeurs
        $artiste->PSEUDOARTISTE             = $request->get('PSEUDOARTISTE');
        $artiste->TELARTISTE                = $request->get('TELARTISTE');
        $artiste->DESCARTISTE               = $request->get('DESCARTISTE');
        $artiste->BIOARTISTE                = $request->get('BIOARTISTE');
        $artiste->SITEINTERNETARTISTE       = $request->get('SITEINTERNETARTISTE');
        $artiste->FACEBOOKARTISTE           = $request->get('FACEBOOKARTISTE');
        $artiste->TWITTERARTISTE            = $request->get('TWITTERARTISTE');
        $artiste->SOUNDCLOUDARTISTE         = $request->get('SOUNDCLOUDARTISTE');
        $artiste->YOUTUBEARTISTE            = $request->get('YOUTUBEARTISTE');
        $artiste->SNAPCHATARTISTE           = $request->get('SNAPCHATARTISTE');
        $artiste->INSTAGRAMARTISTE          = $request->get('INSTAGRAMARTISTE');
        $artiste->PRENOMMANAGER             = $request->get('PRENOMMANAGER');
        $artiste->NOMMANAGER                = $request->get('NOMMANAGER');
        $artiste->EMAILMANAGER              = $request->get('EMAILMANAGER');
        $artiste->TELMANAGER                = $request->get('TELMANAGER');

        # On persiste en BDD
        $artiste->save();

        # On redirige l'utilisateur sur sa page profile
        return $app->redirect('membre/artiste/profil.html.twig\'');

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

    /**
     * @param Application $app
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function artistesAction(Application $app) {
        # Récupérer la liste des artistes
           $artistes = $app['idiorm.db']->for_table('view_artistes')->find_result_set();

        # Affichage dans la Vue
        return $app['twig']->render('membre/artiste/artistes.html.twig', [
            'artistes' => $artistes
        ]);
    }

}
