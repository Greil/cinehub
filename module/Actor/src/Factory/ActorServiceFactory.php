<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 14:52
 */
declare(strict_types = 1);


namespace Actor\Factory;


use Actor\Entity\Actor;
use Actor\Repository\ActorRepository;
use Actor\Service\ActorService;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class ActorServiceFactory implements FactoryInterface
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
        /** @var ActorRepository $actorRepository */
        $actorRepository = $entityManager->getRepository(Actor::class);

        return new ActorService($entityManager, $actorRepository);
    }
}
