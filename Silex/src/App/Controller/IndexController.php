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

    public function articleAction($slugarticle,
                                  $idarticle, Application $app) {
        # index.php/business/une-formation-innovante-a-denain_98426852.html
        # Récupération de l'Article
        $article = $app['idiorm.db']->for_table('article')
            ->find_one($idarticle);

        return $app['twig']->render('article.html.twig', [
            'article'       => $article,
        ]);
    }


}
