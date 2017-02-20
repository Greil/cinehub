<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 14:52
 */
declare(strict_types = 1);


namespace Director\Factory;


use Director\Entity\Director;
use Director\Repository\DirectorRepository;
use Director\Service\DirectorService;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class DirectorServiceFactory implements FactoryInterface
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
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var DirectorRepository $directorRepository */
        $directorRepository = $entityManager->getRepository(Director::class);

        return new DirectorService($entityManager, $directorRepository);
    }
}
