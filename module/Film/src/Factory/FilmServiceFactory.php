<?php
/**
 * User: remi_k
 * Date: 21/02/2017
 * Time: 16:37
 */
declare(strict_types = 1);


namespace Film\Factory;


use Doctrine\ORM\EntityManager;
use Film\Entity\Film;
use Film\Repository\FilmRepository;
use Film\Service\FilmService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class FilmServiceFactory implements FactoryInterface
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
        /** @var FilmRepository $filmRepository */
        $filmRepository = $entityManager->getRepository(Film::class);

        return new FilmService($entityManager, $filmRepository);
    }
}
