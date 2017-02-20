<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 11:13
 */
declare(strict_types = 1);


namespace Genre\Factory;


use Genre\Controller\GenreController;
use Genre\Form\AddGenreForm;
use Genre\Form\EditGenreForm;
use Genre\Service\GenreService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class GenreControllerFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var GenreService $genreService */
        $genreService = $container->get(GenreService::class);
        /** @var AddGenreForm $addGenreForm */
        $addGenreForm = $container->get('FormElementManager')->get(AddGenreForm::class);
        /** @var EditGenreForm $editGenreForm */
        $editGenreForm = $container->get('FormElementManager')->get(EditGenreForm::class);

        return new GenreController($genreService, $addGenreForm, $editGenreForm);
    }
}
