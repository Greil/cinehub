<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 11:52
 */
declare(strict_types = 1);

namespace Genre\Form;

use Genre\Form\Fieldset\GenreFieldset;
use Zend\Form\Element\Submit;
use Zend\Form\Form;

class AddGenreForm extends Form
{
    public function __construct()
    {
        parent::__construct('genre');
    }

    public function init()
    {
        $this->add(
            [
                'name'    => 'genre',
                'type'    => GenreFieldset::class,
                'options' => [
                    'use_as_base_fieldset' => true
                ]
            ]
        );

        $this->setValidationGroup(
            [
                'genre' => [
                    'id',
                    'label'
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'submit',
                'type'       => Submit::class,
                'attributes' => [
                    'value' => 'Ajouter',
                    'id'    => 'submitbutton'
                ]
            ]
        );
    }
}
