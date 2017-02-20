<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 11:32
 */
declare(strict_types = 1);


namespace Genre\Service;


use Doctrine\ORM\EntityManager;
use Genre\Entity\Genre;
use Genre\Repository\GenreRepository;

class GenreService implements GenreServiceInterface
{

    /**
     * @var GenreRepository
     */
    private $genreRepository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(
        EntityManager $entityManager,
        GenreRepository $genreRepository
    ) {
        $this->entityManager   = $entityManager;
        $this->genreRepository = $genreRepository;
    }

    /**
     * @return Genre[]
     */
    public function getAllGenres()
    {
        return $this->genreRepository->findAllGenres();
    }

    /**
     * @param int $id
     *
     * @return Genre|null
     */
    public function getGenreById(int $id): Genre
    {
        return $this->genreRepository->findOneById($id);
    }

    public function create(Genre $genre): Genre
    {
        $this->entityManager->persist($genre);
        $this->entityManager->flush($genre);
        return $genre;
    }

    public function edit(Genre $genre): Genre
    {
        $this->entityManager->flush($genre);
        return $genre;
    }

    public function delete(Genre $genre): bool
    {
        try {
            $this->entityManager->remove($genre);
            $this->entityManager->flush($genre);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
