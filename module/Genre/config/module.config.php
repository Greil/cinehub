<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
declare(strict_types=1);

namespace Genre;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Genre\Controller\GenreController;
use Genre\Factory\GenreControllerFactory;
use Genre\Factory\GenreFieldsetFactory;
use Genre\Factory\GenreServiceFactory;
use Genre\Form\AddGenreForm;
use Genre\Form\EditGenreForm;
use Genre\Form\Fieldset\GenreFieldset;
use Genre\Service\GenreService;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            GenreController::class => GenreControllerFactory::class
        ],
    ],

    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => GenreController::class,
                        'action'     => 'index',
                    ]
                ]
            ],
            'genre' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/genre[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => GenreController::class,
                        'action'     => 'index'
                    ],
                ],
            ],
        ],
    ],

    'form_elements' => [
        'factories' => [
            GenreFieldset::class => GenreFieldsetFactory::class,
            AddGenreForm::class  => InvokableFactory::class,
            EditGenreForm::class => InvokableFactory::class
        ]
    ],

    'doctrine' => [
        'driver' => [
            'genre_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    'module/Genre/src/Entity'
                ]
            ],

            'orm_default' => [
                'drivers' => [
                    'Genre\Entity' => 'genre_driver'
                ]
            ]
        ]
    ],

    'service_manager' => [
        'factories' => [
            GenreService::class => GenreServiceFactory::class
        ]
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'     => __DIR__ . '/../view/error/404.phtml',
            'error/index'   => __DIR__ . '/../view/error/index.phtml'
        ],
        'template_path_stack' => [
            'genre' => __DIR__ . '/../view',
        ],
    ],
];
