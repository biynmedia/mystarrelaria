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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function inscriptionPost(Application $app, Request $request) {
        # Vérification et la Sécurisation des données POST
        # ...

        if (!empty($email)) :

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) :

                $erreurs['isEmailInDb'] = true;

            else :
                # Mon email est valide, je vérifie dans la BDD s'il n'est pas déjà présent.
                $isEmailInDb = ORM::for_table('membre')
                                    ->where('EMAILMEMBRE', $email)
                                    ->count();

                if (!$isEmailInDb) :

                    # Connexion à la BDD
                    $membre = $app['idiorm.db']->for_table('membre')->create();

                    # Affectation de Valeurs
                    $membre->NOMMEMBRE      = $request->get('NOMMEMBRE');
                    $membre->PRENOMMEMBRE   = $request->get('PRENOMMEMBRE');
                    $membre->EMAILMEMBRE    = $email = $request->get('EMAILMEMBRE');
                    $membre->MDPMEMBRE      = $app['security.default_encoder']
                        ->encodePassword($request->get('MDPMEMBRE'), '');
                    $membre->ROLEMEMBRE     = serialize(['ROLE_MEMBRE']); // TODO : Serialize des Roles

                    # On persiste en BDD
                    $membre->save();

                else :

                    $erreurs['isEmailInDb'] = true;

                endif;

            endif;

        else :

            # Sinon, je log l'erreur dans un tableau errors
            $erreurs['isEmailInDb'] = true;

        endif;

        # Une fois le traitement terminé, on va faire une retour à l'application.
        if(!isset($erreurs)) :

            # Tous s'est bien passé, je renvoi une réponse positive
            echo json_encode(['success' => true]);

        else :

            # Sinon, il y a des erreurs, je retourne mon tableau d'erreurs.
            echo json_encode([
                'success'   => false,
                'erreurs'   => $erreurs
            ]);

        endif;


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
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username')
        ]);
    }

}
