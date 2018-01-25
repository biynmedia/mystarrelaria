<?php
namespace App\Controller;

use Silex\Application;

class IndexController
{
    /**
     * Affichage de la Page d'Accueil
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function indexAction(Application $app) {
        
        # Déclaration d'un Message
        $message = 'Mon Application Silex !';
       
        # Affichage dans la Vue
        return $app['twig']->render('index.html.twig',[
            'message'  => $message
        ]);
    }



    /**
     * Affichages des Artistes du site
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function artistesAction(Application $app) {
        # Récupérer la liste des artistes
        $artistes = $app['idiorm.db']->for_table('view_artistes')->find_result_set();

        # Affichage dans la Vue
        return $app['twig']->render('membre/artiste/artistes.html.twig', [
            'artistes' => $artistes
        ]);
    }

    public function artistesInfo(Application $app) {
        # Récupérer les informations des artistes
        $info = $app['idiorm.db']->for_table('artiste')->find_result_set();

        # Affichage dans la Vue
        return $app['twig']->render('membre/artiste/profil.html.twig', [
            'info' => $info
        ]);
    }


    public function sidebar(Application $app) {
        # Récupération des Informations pour la Sidebar
        # Ici il n'y a pas de données en bdd pour la sidebar, est-ce que ceci est obligatoire?
        $sidebar = $app['idiorm.db']->for_table('')
            ->order_by_desc('')
            ->find_result_set();


        # Transmission à la Vue
        return $app['twig']->render('sidebar.html.twig', [
            'sidebar'    => $sidebar
        ]);
    }

}
