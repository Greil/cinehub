<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 11:52
 */
declare(strict_types = 1);

namespace Director\Form;

use Director\Form\Fieldset\DirectorFieldset;
use Zend\Form\Element\Submit;
use Zend\Form\Form;

class EditDirectorForm extends Form
{
    public function __construct()
    {
        parent::__construct('director');
    }

    public function init()
    {
        $this->add(
            [
                'name'    => 'director',
                'type'    => DirectorFieldset::class,
                'options' => [
                    'use_as_base_fieldset' => true
                ]
            ]
        );

        $this->setValidationGroup(
            [
                'director' => [
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
