<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 15:07
 */
declare(strict_types = 1);

namespace Director\Form\Fieldset;

use Director\Entity\Director;
use Doctrine\ORM\EntityManager;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\Form\Element\DateTime;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Validator\StringLength;

class DirectorFieldset extends Fieldset implements InputFilterProviderInterface
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
            ->setObject(new Director());

        $this->add(
            [
                'name' => 'id',
                'type' => Hidden::class
            ]
        );

        $this->add(
            [
                'name'    => 'firstname',
                'type'    => Text::class,
                'options' => [
                    'label' => 'Prénom'
                ]
            ]
        );

        $this->add(
            [
                'name'    => 'lastname',
                'type'    => Text::class,
                'options' => [
                    'label' => 'Nom'
                ]
            ]
        );

        $this->add(
            [
                'name'    => 'birthDate',
                'type'    => DateTime::class,
                'options' => [
                    'label'  => 'Date de naissance',
                    'format' => 'd-m-Y'
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
                'filters' => [
                    ['name' => ToInt::class]
                ]
            ],
            'firstname' => [
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50
                    ]
                ]
            ],
            'lastname' => [
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50
                    ]
                ]
            ],
            'birthDate' => [
                'required' => true,
                'validators' => [
                    'name' => \Zend\I18n\Validator\DateTime::class,
                    'options' => [
                        'pattern' => 'd-m-Y',
                        'message' => 'Le format de la date doit être "d-m-Y"',
                    ]
                ]
            ]
        ];
    }
}
