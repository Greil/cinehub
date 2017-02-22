<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 11:52
 */
declare(strict_types = 1);

namespace Actor\Form;

use Actor\Form\Fieldset\ActorFieldset;
use Zend\Form\Element\Submit;
use Zend\Form\Form;

class EditActorForm extends Form
{
    public function __construct()
    {
        parent::__construct('actor');
    }

    public function init()
    {
        $this->add(
            [
                'name'    => 'actor',
                'type'    => ActorFieldset::class,
                'options' => [
                    'use_as_base_fieldset' => true
                ]
            ]
        );

        $this->setValidationGroup(
            [
                'actor' => [
                    'id',
                    'firstname',
                    'lastname',
                    'birthDate'
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'submit',
                'type'       => Submit::class,
                'attributes' => [
                    'value' => 'Modifier',
                    'id'    => 'submitbutton'
                ]
            ]
        );
    }
}
