<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
declare(strict_types=1);

namespace Director;

use Director\Controller\DirectorController;
use Director\Factory\DirectorControllerFactory;
use Director\Factory\DirectorFieldsetFactory;
use Director\Factory\DirectorServiceFactory;
use Director\Form\AddDirectorForm;
use Director\Form\EditDirectorForm;
use Director\Form\Fieldset\DirectorFieldset;
use Director\Service\DirectorService;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            DirectorController::class => DirectorControllerFactory::class
        ],
    ],

    'router' => [
        'routes' => [
            'director' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/director[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\DirectorController::class,
                        'action'     => 'index'
                    ],
                ],
            ],
        ],
    ],

    'form_elements' => [
        'factories' => [
            DirectorFieldset::class => DirectorFieldsetFactory::class,
            AddDirectorForm::class  => InvokableFactory::class,
            EditDirectorForm::class => InvokableFactory::class,
        ]
    ],

    'doctrine' => [
        'driver' => [
            'director_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    'module/Director/src/Entity'
                ]
            ],

            'orm_default' => [
                'drivers' => [
                    'Director\Entity' => 'director_driver'
                ]
            ]
        ]
    ],

    'service_manager' => [
        'factories' => [
            DirectorService::class => DirectorServiceFactory::class
        ]
    ],

    'view_manager' => [
        'template_path_stack' => [
            'director' => __DIR__ . '/../view',
        ],
    ],
];
