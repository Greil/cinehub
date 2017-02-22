<?php
/**
 * User: remi_k
 * Date: 22/02/2017
 * Time: 10:01
 */
namespace Film;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Film\Controller\FilmController;
use Film\Factory\FilmControllerFactory;
use Film\Factory\FilmFieldsetFactory;
use Film\Factory\FilmServiceFactory;
use Film\Form\AddFilmForm;
use Film\Form\EditFilmForm;
use Film\Form\Fieldset\FilmFieldset;
use Film\Service\FilmService;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            FilmController::class => FilmControllerFactory::class
        ]
    ],

    'router' => [
        'routes' => [
            'film' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/film[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\FilmController::class,
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ],

    'form_elements' => [
        'factories' => [
            FilmFieldset::class => FilmFieldsetFactory::class,
            AddFilmForm::class  => InvokableFactory::class,
            EditFilmForm::class => InvokableFactory::class
        ]
    ],

    'doctrine' => [
        'driver' => [
            'film_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    'module/Film/src/Entity'
                ]
            ],

            'orm_default' => [
                'drivers' => [
                    'Film\Entity' => 'film_driver'
                ]
            ]
        ]
    ],

    'service_manager' => [
        'factories' => [
            FilmService::class => FilmServiceFactory::class
        ]
    ],

    'view_manager' => [
        'template_path_stack' => [
            'film' => __DIR__ . '/../view'
        ]
    ]
];
