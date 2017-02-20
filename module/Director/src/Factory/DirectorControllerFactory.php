<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 15:03
 */
declare(strict_types = 1);


namespace Director\Factory;


use Director\Controller\DirectorController;
use Director\Form\AddDirectorForm;
use Director\Service\DirectorService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class DirectorControllerFactory implements FactoryInterface
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
        /** @var DirectorService $directorService */
        $directorService = $container->get(DirectorService::class);
        /** @var AddDirectorForm $addDirectorForm */
        $addDirectorForm = $container->get('FormElementManager')->get(AddDirectorForm::class);

        return new DirectorController($directorService, $addDirectorForm);
    }
}
