<?php
/**
 * User: remi_k
 * Date: 22/02/2017
 * Time: 10:12
 */
declare(strict_types = 1);


namespace Film\Factory;


use Film\Controller\FilmController;
use Film\Form\AddFilmForm;
use Film\Form\EditFilmForm;
use Film\Service\FilmService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class FilmControllerFactory implements FactoryInterface
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
        /** @var FilmService $filmService */
        $filmService = $container->get(FilmService::class);
        /** @var AddFilmForm $addFilmForm */
        $addFilmForm = $container->get('FormElementManager')->get(AddFilmForm::class);
        /** @var EditFilmForm $editFilmForm */
        $editFilmForm = $container->get('FormElementManager')->get(EditFilmForm::class);

        return new FilmController($filmService, $addFilmForm, $editFilmForm);
    }
}
