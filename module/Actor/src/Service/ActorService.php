<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 14:54
 */
declare(strict_types = 1);

namespace Actor\Service;

use Actor\Entity\Actor;
use Actor\Repository\ActorRepository;
use Doctrine\ORM\EntityManager;

class ActorService implements ActorServiceInterface
{

    /** @var ActorRepository */
    private $actorRepository;

    /** @var EntityManager  */
    private $entityManager;

    public function __construct(
        EntityManager $entityManager,
        ActorRepository $actorRepository
    ) {
        $this->entityManager   = $entityManager;
        $this->actorRepository = $actorRepository;
    }

    /**
     * @return Actor[]
     */
    public function getAllActors()
    {
        return $this->actorRepository->findAllActors();
    }

    /**
     * @param int $id
     *
     * @return Actor|null
     */
    public function getActorById(int $id): Actor
    {
        return $this->actorRepository->findOneById($id);
    }

    public function create(Actor $actor): Actor
    {
        $this->entityManager->persist($actor);
        $this->entityManager->flush($actor);
        return $actor;
    }

    public function edit(Actor $actor): Actor
    {
        $this->entityManager->flush($actor);
        return $actor;
    }

    public function delete(Actor $actor): bool
    {
        try {
            $this->entityManager->remove($actor);
            $this->entityManager->flush($actor);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
