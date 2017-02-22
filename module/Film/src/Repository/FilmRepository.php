<?php
/**
 * User: remi_k
 * Date: 21/02/2017
 * Time: 15:54
 */
declare(strict_types = 1);


namespace Film\Repository;


use Doctrine\ORM\EntityRepository;
use Film\Entity\Film;

class FilmRepository extends EntityRepository
{
    public function findAllFilms()
    {
        return $this->createQueryBuilder('f')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     *
     * @return Film|null
     */
    public function findOneById(int $id)
    {
        $qb = $this->createQueryBuilder('f')
            ->where('f.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()
            ->getOneOrNullResult();
    }
}
