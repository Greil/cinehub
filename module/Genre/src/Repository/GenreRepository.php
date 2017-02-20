<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 11:18
 */
declare(strict_types = 1);

namespace Genre\Repository;

use Doctrine\ORM\EntityRepository;
use Genre\Entity\Genre;

class GenreRepository extends EntityRepository
{
    public function findAllGenres()
    {
        return $this->createQueryBuilder('g')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     *
     * @return Genre|null
     */
    public function findOneById(int $id)
    {
        $qb = $this->createQueryBuilder('g')
            ->where('g.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()
            ->getOneOrNullResult();
    }
}
