<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 14:42
 */
declare(strict_types = 1);

namespace Director\Repository;

use Director\Entity\Director;
use Doctrine\ORM\EntityRepository;

class DirectorRepository extends EntityRepository
{
    public function findAllDirectors()
    {
        return $this->createQueryBuilder('r')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     *
     * @return Director|null
     */
    public function findOneById(int $id)
    {
        $qb = $this->createQueryBuilder('r')
            ->where('r.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()
            ->getOneOrNullResult();
    }
}
