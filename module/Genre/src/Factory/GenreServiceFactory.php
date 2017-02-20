<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 11:30
 */
declare(strict_types = 1);


namespace Genre\Factory;


use Doctrine\ORM\EntityManager;
use Genre\Entity\Genre;
use Genre\Repository\GenreRepository;
use Genre\Service\GenreService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class GenreServiceFactory implements FactoryInterface
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
        /** @var GenreRepository $genreRepository */
        $genreRepository = $entityManager->getRepository(Genre::class);

        return new GenreService($entityManager, $genreRepository);
    }
}
