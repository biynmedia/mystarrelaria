<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Traits\Helper;

class ArticleController
{

    use Helper;

    public function addarticleAction(Application $app, Request $request){

        # Formulaire

        $form = $app['form.factory']->createBuilder(FormType::class)

            ->add('TITREARTICLE', TextType::class, [
                'required'     => true,
                'label'        => false,
                'constraints'  => array(new NotBlank()),
                'attr'         => [
                    'class'         => 'form-control',
                    'placeholder'   => 'Titre de l\'article...'
                ]
            ])
            ->add('CONTENUARTICLE', TextareaType::class, [
                'required'     => true,
                'label'        => false,
                'constraints'  => array(new NotBlank()),
                'attr'         => [
                    'class'         => 'form-control'
                ]
            ])
            ->add('FEATUREDIMAGEARTICLE', FileType::class, [
                'required'  => false,
                'label'     => false,
                'attr'      => [
                    'class' => 'dropify'
                ]
            ])
            ->add('SPECIALARTICLE', CheckboxType::class, [
                'required'  => false,
                'label'     => false,
            ])
            ->add('SPOTLIGHTARTICLE', CheckboxType::class, [
                    'required'  => false,
                    'label'     => false,
            ])
            ->add('sumbit', SubmitType::class, ['label' => 'Publier'])

            ->getForm();


        $form->handleRequest($request);

        # Verification formulaire
        if ($form->isValid()) :
            # Verification des données
            $article = $form->getData();

        # Récuperation Image
        $image  = $article['FEATUREDIMAGEARTICLE'];
        $chemin = PATH_PUBLIC . '/assets/images/articles';
        $image->move($chemin, $this->slugify($article['TITREARTICLE']).'.jpg');


        # Insertion en BDD
        $articleDb = $app['idiorm.db']->for_table('article')->create();

            $articleDb->TITREARTICLE            =   $article['TITREARTICLE'];
            $articleDb->CONTENUARTICLE          =   $article['CONTENUARTICLE'];
            $articleDb->SPECIALARTICLE          =   $article['SPECIALARTICLE'];
            $articleDb->SPOTLIGHTARTICLE        =   $article['SPOTLIGHTARTICLE'];
            $articleDb->FEATUREDIMAGEARTICLE    =   $this->slugify($article['TITREARTICLE']).'.jpg';

            $articleDb->save();

            # Redirection sur l'article
        return $app->redirect($app['url_generator']->generate(
            'news_article', [
                'slugarticle'       => $this->slugify($article['TITREARTICLE']),
                'idarticle'         => $articleDb->id()
            ]
        ));

        endif;

        # Affichage du Formulaire dans la vue
        return $app['twig']->render('admin/ajouterarticle.html.twig', [
            'form' => $form->createView()
        ]);

    }

}