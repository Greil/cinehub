<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
declare(strict_types=1);

namespace Actor;

use Actor\Controller\ActorController;
use Actor\Factory\ActorControllerFactory;
use Actor\Factory\ActorFieldsetFactory;
use Actor\Factory\ActorServiceFactory;
use Actor\Form\AddActorForm;
use Actor\Form\EditActorForm;
use Actor\Form\Fieldset\ActorFieldset;
use Actor\Service\ActorService;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            ActorController::class => ActorControllerFactory::class
        ],
    ],

    'router' => [
        'routes' => [
            'actor' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/actor[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ActorController::class,
                        'action'     => 'index'
                    ],
                ],
            ],
        ],
    ],

    'form_elements' => [
        'factories' => [
            ActorFieldset::class => ActorFieldsetFactory::class,
            AddActorForm::class  => InvokableFactory::class,
            EditActorForm::class => InvokableFactory::class,
        ]
    ],

    'doctrine' => [
        'driver' => [
            'actor_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    'module/Actor/src/Entity'
                ]
            ],

            'orm_default' => [
                'drivers' => [
                    'Actor\Entity' => 'actor_driver'
                ]
            ]
        ]
    ],

    'service_manager' => [
        'factories' => [
            ActorService::class => ActorServiceFactory::class
        ]
    ],

    'view_manager' => [
        'template_path_stack' => [
            'actor' => __DIR__ . '/../view',
        ],
    ],
];
