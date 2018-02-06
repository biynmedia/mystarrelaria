<?php
namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

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
        $artistes   = $app['idiorm.db']->for_table('view_artistes')->find_result_set();
        $genre      = $app['idiorm.db']->for_table('genre')->find_result_set();

        # Affichage dans la Vue
        return $app['twig']->render('membre/artiste/artistes.html.twig', [
            'artistes'  => $artistes,
            'genre'     => $genre
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

    public function inscriptionAction(Application $app) {
        return $app['twig']->render('inscription.html.twig');
    }

    /**
     * Traitement POST du Formulaire d'Inscription
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function inscriptionPost(Application $app, Request $request) {

        $error = '';

        # Vérification si l'adresse email existe
        $isEmailInDb = $app['idiorm.db']->for_table('membre')
            ->where('EMAILMEMBRE', $request->get('EMAILMEMBRE'))
            ->count();

            # Si elle n'existe pas, on inscrit le membre.
            if(!$isEmailInDb) :

                    # Connexion à la BDD
                    $membre = $app['idiorm.db']->for_table('membre')->create();

                    # Affectation de Valeurs
                    $membre->NOMMEMBRE      = $request->get('NOMMEMBRE');
                    $membre->PRENOMMEMBRE   = $request->get('PRENOMMEMBRE');
                    $membre->EMAILMEMBRE    = $request->get('EMAILMEMBRE');
                    $membre->MDPMEMBRE      = $app['security.default_encoder']
                        ->encodePassword($request->get('MDPMEMBRE'), '');
                    $membre->ROLEMEMBRE     = serialize(['ROLE_MEMBRE']);

                    # On persiste en BDD
                    $membre->save();

                    // TODO Envoi d'un email de bievenue au membre
                    // TODO Création d'un Log, Inscription d'un Utilisateur

                # On redirige l'utilisateur sur la page de connexion
                return $app->redirect('connexion.html?inscription=success');

            else :
                $error = 'Ce compte existe déjà. Mot de passe oublié ?';
            endif;

        return $app['twig']->render('inscription.html.twig', [
            'error' => $error
        ]);

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
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username')
        ]);
    }

}
