<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 15:03
 */
declare(strict_types = 1);


namespace Actor\Factory;


use Actor\Controller\ActorController;
use Actor\Form\AddActorForm;
use Actor\Form\EditActorForm;
use Actor\Service\ActorService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class ActorControllerFactory implements FactoryInterface
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
        /** @var ActorService $actorService */
        $actorService = $container->get(ActorService::class);
        /** @var AddActorForm $addActorForm */
        $addActorForm = $container->get('FormElementManager')->get(AddActorForm::class);
        /** @var EditActorForm $editActorForm */
        $editActorForm = $container->get('FormElementManager')->get(EditActorForm::class);

        return new ActorController($actorService, $addActorForm, $editActorForm);
    }
}
