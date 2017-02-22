<?php
/**
 * User: remi_k
 * Date: 21/02/2017
 * Time: 16:46
 */
declare(strict_types = 1);


namespace Film\Form\Fieldset;

use Actor\Entity\Actor;
use Director\Entity\Director;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Form\Element\ObjectSelect;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Film\Entity\Film;
use Genre\Entity\Genre;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;

class FilmFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $objectManager;

    public function __construct(EntityManager $objectManager)
    {
        $this->objectManager = $objectManager;
        parent::__construct();
    }

    public function init()
    {
        $this->setHydrator(new DoctrineHydrator($this->objectManager))
            ->setObject(new Film());

        $this->add(
            [
                'name' => 'id',
                'type' => Hidden::class
            ]
        );

        $this->add(
            [
                'name'    => 'title',
                'type'    => Text::class,
                'options' => [
                    'label' => 'Titre'
                ]
            ]
        );

        $this->add(
            [
                'name'    => 'genre',
                'type'    => ObjectSelect::class,
                'options' => [
                    'label'          => 'Genre',
                    'object_manager' => $this->objectManager,
                    'target_class'   => Genre::class,
                    'is_method'      => true,
                    'find_method'    => [
                        'name' => 'findAllGenres'
                    ],
                    'property'           => 'label',
                    'display_empty_item' => true,
                ]
            ]
        );

        $this->add(
            [
                'name'    => 'director',
                'type'    => ObjectSelect::class,
                'options' => [
                    'label'          => 'Réalisateur',
                    'object_manager' => $this->objectManager,
                    'target_class'   => Director::class,
                    'is_method'      => true,
                    'find_method'    => [
                        'name' => 'findAllDirectors'
                    ],
                    'property'           => 'fullname',
                    'display_empty_item' => true,
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'actors',
                'type'       => ObjectSelect::class,
                'attributes' => [
                    'multiple' => 'multiple'
                ],
                'options' => [
                    'label'        => 'Acteurs',
                    'target_class' => Actor::class,
                    'is_method'    => true,
                    'find_method'  => [
                        'name' => 'findAllActors'
                    ],
                    'property'           => 'fullname',
                    'display_empty_item' => true,
                ]
            ]
        );

        $this->add(
            [
                'name'    => 'note',
                'type'    => Text::class,
                'options' => [
                    'label' => 'Note (/5)'
                ]
            ]
        );

        $this->add(
            [
                'name'    => 'releaseYear',
                'type'    => Text::class,
                'options' => [
                    'label' => 'Année de sortie'
                ]
            ]
        );

        $this->add(
            [
                'name'    => 'synopsis',
                'type'    => Textarea::class,
                'options' => [
                    'label' => 'Synopsis'
                ]
            ]
        );
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            'id' => [
                'required' => true,
                'filters'  => [
                    ['name' => ToInt::class]
                ]
            ],
            'title' => [
                'required' => true,
                'filters'  => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class]
                ],
                'validators' => [
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100
                        ]
                    ]
                ]
            ],
            'releaseYear' => [
                'required' => true,
                'filters'  => [
                    ['name' => ToInt::class]
                ]
            ],
            'synopsis' => [
                'required' => true,
                'filters'  => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1
                        ]
                    ]
                ]
            ]
        ];
    }
}
