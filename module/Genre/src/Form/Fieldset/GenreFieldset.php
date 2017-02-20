<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 11:53
 */
declare(strict_types = 1);


namespace Genre\Form\Fieldset;


use Doctrine\ORM\EntityManager;
use Genre\Entity\Genre;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Validator\StringLength;

class GenreFieldset extends Fieldset implements InputFilterProviderInterface
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
            ->setObject(new Genre());

        $this->add(
            [
                'name' => 'id',
                'type' => Hidden::class
            ]
        );

        $this->add(
            [
                'name'    => 'label',
                'type'    => Text::class,
                'options' => [
                    'label' => 'Libelle'
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
            'label' => [
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
                            'max'      => 50
                        ]
                    ]
                ]
            ]
        ];
    }
}
