<?php
/**
 * User: remi_k
 * Date: 22/02/2017
 * Time: 10:19
 */
declare(strict_types = 1);


namespace Film\Form;


use Film\Form\Fieldset\FilmFieldset;
use Zend\Form\Element\Submit;
use Zend\Form\Form;

class AddFilmForm extends Form
{
    public function __construct()
    {
        parent::__construct('film');
    }

    public function init()
    {
        $this->add(
            [
                'name' => 'film',
                'type' => FilmFieldset::class,
                'options' => [
                    'use_as_base_fieldset' => true
                ]
            ]
        );

        $this->setValidationGroup(
            [
                'film' => [
                    'id',
                    'title',
                    'genre',
                    'director',
                    'actors',
                    'note',
                    'releaseYear',
                    'synopsis'
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
