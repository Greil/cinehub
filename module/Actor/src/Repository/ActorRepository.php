<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 14:42
 */
declare(strict_types = 1);

namespace Actor\Repository;

use Actor\Entity\Actor;
use Doctrine\ORM\EntityRepository;

class ActorRepository extends EntityRepository
{
    public function findAllActors()
    {
        return $this->createQueryBuilder('a')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     *
     * @return Actor|null
     */
    public function findOneById(int $id)
    {
        $qb = $this->createQueryBuilder('a')
            ->where('a.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()
            ->getOneOrNullResult();
    }
}
