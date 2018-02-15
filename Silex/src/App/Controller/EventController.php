<?php

namespace App\Controller;


use Silex\Application;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class EventController
{

    public function addeventAction(Application $app, Request $request) {

        $localisations = function() use ($app) {
            $localisations = $app['idiorm.db']->for_table('localisation')
                                             ->find_result_set();

            $array = [];
            foreach ($localisations as $localisation) :
                $array[$localisation->PAYSLOCALISATION] = $localisation->IDLOCALISATION;
            endforeach;

            return $array;
        };

        $disponibilites = function() use ($app) {
          $disponibilites = $app['idiorm.db']->for_table('typedisponibilite')
                                             ->find_result_set();

          $array = [];
          foreach ($disponibilites as $disponibilite) :
              $array[$disponibilite->LIBELLETYPEDISPONIBILITE] = $disponibilite->IDTYPEDISPONIBILITE;
          endforeach;

          return $array;

        };

        $genres = function() use ($app) {
            $genres = $app['idiorm.db']->for_table('genre')
                                       ->find_result_set();

            $array = [];
            foreach ($genres as $genre) :
                $array[$genre->NOMGENRE] = $genre->IDGENRE;
            endforeach;

            return $array;
        };


        $form = $app['form.factory']->createBuilder(FormType::class)
            ->add('DATEDISPONIBILITE', DateType::class, array(
                'widget'  => 'single_text',
                'label'   => false,
                'html5'   => false,
                'attr'    => ['class' => 'js-datepicker'],
            ))

            ->add('IDLOCALISATION', ChoiceType::class, [
                'choices'   => $localisations(),
                'expanded'  => false,
                'multiple'  => false,
                'label'     => false,
                'attr'      => [
                    'class'     => 'form-control'
                ]
            ])
            ->add('IDDISPONIBILITE', ChoiceType::class, [
                'choices'   => $disponibilites(),
                'expanded'  => false,
                'multiple'  => false,
                'label'     => false,
                'attr'      => [
                    'class'     => 'form-control'
                ]
            ])
            ->add('IDGENRE', ChoiceType::class, [
                'choices'   => $genres(),
                'expanded'  => 'checkboxes',
                'multiple'  => true,
                'label'     => false,
                'attr'      => [
                    'class'     => 'form-control'
                ]
            ])
            ->add('sumbit', SubmitType::class, ['label' => 'Chercher'])

            ->getForm();


        return $app['twig']->render('evenement/evenement.html.twig', [
            'form' => $form->createView()
        ]);
    }

}