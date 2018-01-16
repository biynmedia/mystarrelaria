<?php
namespace App\Controller;


use App\Traits\Helper;
use Silex\Application;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class ArtisteController
 * @package App\Controller
 */
class ArtisteController
{

    use Helper;

    /**
     * Affichage de la Page Inscription
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function inscriptionAction(Application $app, Request $request) {


        # Récupération la liste des genres
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

        # Créer un Formulaire permettant l'inscription d'un Artiste
        $form = $app['form.factory']->createBuilder(FormType::class)

            # Champ PSEUDOARTISTE
            ->add('PSEUDOARTISTE', TextType::class, [
                'required'          => true,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                    'placeholder'       => 'Pseudo..',
                    'data-progression',
                    'data-helper'       => 'Help users through forms by prividing helpful hinters'
                ]
            ])

            ->add('IMAGEARTISTE', FileType::class, [
                'required'          => false,
                'label'             => false,
                'attr'              => [
                    'class'             => 'dropify',
                ]
            ])

            ->add('TELARTISTE', TextType::class, [
                'required'          => true,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                    'placeholder'       => 'Téléphone..',
                ]
            ])
            ->add('IDGENRE', ChoiceType::class, [
                'choices'           => $genres(),
                'expanded'          => false,
                'multiple'          => false,
                'label'             => false,
                'attr'                  => [
                    'class'                 => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required'
                ]
            ])
            ->add('DESCARTISTE', TextareaType::class, [
                'required'          => false,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-textarea',
                    'placeholder'       => 'Decrivez vous..'
                ]
            ])
            ->add('BIOARTISTE', TextareaType::class, [
                'required'          => true,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-textarea',
                    'placeholder'       => 'Votre biographie..'
                ]
            ])
            ->add('NOMMANAGER', TextType::class, [
                'required'          => false,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                    'placeholder'       => 'Nom de votre manager..'
                ]
            ])
            ->add('PRENOMMANAGER', TextType::class, [
                'required'          => false,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                    'placeholder'       => 'Prénom de votre manager..'
                ]
            ])
            ->add('EMAILMANAGER', TextType::class, [
                'required'          => false,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                    'placeholder'       => 'Email..'
                ]
            ])
            ->add('TELMANAGER', TextType::class, [
                'required'          => false,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                    'placeholder'       => 'Téléphone..'
                ]
            ])
            ->add('SITEINTERNETARTISTE', TextType::class, [
                'required'          => false,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                    'placeholder'       => 'URL..'
                ]
            ])
            ->add('FACEBOOKARTISTE', TextType::class, [
                'required'          => false,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                    'placeholder'       => 'URL..'
                ]
            ])
            ->add('TWITTERARTISTE', TextType::class, [
                'required'          => false,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                    'placeholder'       => '@..'
                ]
            ])
            ->add('SOUNDCLOUDARTISTE', TextType::class, [
                'required'          => false,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                    'placeholder'       => 'URL..'
                ]
            ])
            ->add('YOUTUBEARTISTE', TextType::class, [
                'required'          => false,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                    'placeholder'       => 'URL..'
                ]
            ])
            ->add('SNAPCHATARTISTE', TextType::class, [
                'required'          => false,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                    'placeholder'       => 'URL..'
                ]
            ])
            ->add('INSTAGRAMARTISTE', TextType::class, [
                'required'          => false,
                'label'             => false,
                'constraints'       => array(new NotBlank()),
                'attr'              => [
                    'class'             => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                    'placeholder'       => 'URL..'
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => "S'inscrire !"])
            ->getForm();

        # Traitement des données POST
        $form->handleRequest($request);

        // Todo La mathode is valid ne retourne rien il faut voir pourquoi...

        echo 'IS VALID : ';
        print_r($form->isValid());

        # Vérification des données du formulaire
//        if ($form->isValid()) :

            # Récuperation des données
            $artistes = $form->getData();

            # Récupération de l'image
            $image  = $artistes['IMAGEARTISTE'];
            $chemin = PATH_PUBLIC . '/assets/images/artistes/'.$this->slugify($artistes['PSEUDOARTISTE']).'/';
            $image->move($chemin, $this->slugify($artistes['PSEUDOARTISTE']).'.jpg');

            # Insertion en BDD
            $artiste = $app['idiorm.db']->for_table('artiste')->create();
            $genre   = $app['idiorm.db']->for_table('genre')->find_one($artistes['IDGENRE']);

            # On assoice les colonnes de notre BDD avec les valeurs du formulaire.

            # Colonne mySQL                         # Valeurs du Formulaire
            $artiste->genre_IDGENRE             = $artistes['IDGENRE'];
            $membre_IDMEMBRE                    = // Todo il faut aussi l'ID du membre connecté... Donc il faut une inscription
            $artiste->PSEUDOARTISTE             = $artistes['PSEUDOARTISTE'];
            $artiste->TELARTISTE                = $artistes['TELARTISTE'];
            $artiste->ALIASARTISTE              = $this->slugify($artistes['PSEUDOARTISTE']);
            $artiste->IMAGEARTISTE              = $this->slugify($artistes['PSEUDOARTISTE']).'.jpg';
            $artiste->DESCARTISTE               = $artistes['DESCARTISTE'];
            $artiste->BIOARTISTE                = $artistes['BIOARTISTE'];
            $artiste->SITEINTERNETARTISTE       = $artistes['SITEINTERNETARTISTE'];
            $artiste->FACEBOOKARTISTE           = $artistes['FACEBOOKARTISTE'];
            $artiste->TWITTERARTISTE            = $artistes['TWITTERARTISTE'];
            $artiste->SOUNDCLOUDARTISTE         = $artistes['SOUNDCLOUDARTISTE'];
            $artiste->YOUTUBEARTISTE            = $artistes['YOUTUBEARTISTE'];
            $artiste->SNAPCHATARTISTE           = $artistes['SNAPCHATARTISTE'];
            $artiste->INSTAGRAMARTISTE          = $artistes['INSTAGRAMARTISTE'];
            $artiste->PRENOMMANAGER             = $artistes['PRENOMMANAGER'];
            $artiste->NOMMANAGER                = $artistes['NOMMANAGER'];
            $artiste->EMAILMANAGER              = $artistes['EMAILMANAGER'];
            $artiste->TELMANAGER                = $artistes['TELMANAGER'];

            print_r($artiste);

            # Insertion en BDD
            $artiste->save();

            # On redirige l'utilisateur sur sa page profile
            // Todo Redirection de l'utilisateur sur la page profil... Ne pourra se faire que lorsque la page sera faite...

//        endif;

        # Affichage du formulaire dans la Vue
        return $app['twig']->render('membre/artiste/inscription.html.twig', [
            'form' => $form->CreateView()
        ]);
    }

    /**
     * Affichage de la Page Inscription
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function profilAction(Application $app) {

        # Création du Formulaire

        # Traitement du Formulaire

        # Affichage dans la Vue
        return $app['twig']->render('membre/artiste/profil.html.twig');
    }

}
