<?php
/**
 * User: remi_k
 * Date: 21/02/2017
 * Time: 16:32
 */
declare(strict_types = 1);


namespace Film\Service;


use Doctrine\ORM\EntityManager;
use Film\Entity\Film;
use Film\Repository\FilmRepository;

class FilmService implements FilmServiceInterface
{

    /** @var FilmRepository */
    private $filmRepository;

    /** @var EntityManager */
    private $entityManager;

    public function __construct(
        EntityManager $entityManager,
        FilmRepository $filmRepository
    ) {
        $this->entityManager  = $entityManager;
        $this->filmRepository = $filmRepository;
    }

    /**
     * @return Film[]
     */
    public function getAllFilms()
    {
        return $this->filmRepository->findAllFilms();
    }

    /**
     * @param int $id
     *
     * @return Film|null
     */
    public function getFilmById(int $id): Film
    {
        return $this->filmRepository->findOneById($id);
    }

    public function create(Film $film): Film
    {
        $this->entityManager->persist($film);
        $this->entityManager->flush($film);
        return $film;
    }

    public function edit(Film $film): Film
    {
        $this->entityManager->flush($film);
        return $film;
    }

    public function delete(Film $film): bool
    {
        try {
            $this->entityManager->remove($film);
            $this->entityManager->flush($film);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
