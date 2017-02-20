<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 14:54
 */
declare(strict_types = 1);

namespace Director\Service;

use Director\Entity\Director;
use Director\Repository\DirectorRepository;
use Doctrine\ORM\EntityManager;

class DirectorService implements DirectorServiceInterface
{

    /** @var DirectorRepository */
    private $directorRepository;

    /** @var EntityManager  */
    private $entityManager;

    public function __construct(
        EntityManager $entityManager,
        DirectorRepository $directorRepository
    ) {
        $this->entityManager      = $entityManager;
        $this->directorRepository = $directorRepository;
    }

    /**
     * @return Director[]
     */
    public function getAllDirectors()
    {
        return $this->directorRepository->findAllDirectors();
    }

    /**
     * @param int $id
     *
     * @return Director|null
     */
    public function getDirectorById(int $id): Director
    {
        return $this->directorRepository->findOneById($id);
    }

    public function create(Director $director): Director
    {
        $this->entityManager->persist($director);
        $this->entityManager->flush($director);
        return $director;
    }

    public function edit(Director $director): Director
    {
        $this->entityManager->flush($director);
        return $director;
    }

    public function delete(Director $director): bool
    {
        try {
            $this->entityManager->remove($director);
            $this->entityManager->flush($director);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
