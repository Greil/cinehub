<?php
/**
 * User: remi_k
 * Date: 21/02/2017
 * Time: 16:28
 */
declare(strict_types = 1);


namespace Film\Service;


use Film\Entity\Film;

interface FilmServiceInterface
{
    /**
     * @return Film[]
     */
    public function getAllFilms();

    /**
     * @param int $id
     *
     * @return Film|null
     */
    public function getFilmById(int $id): Film;

    public function create(Film $film): Film;

    public function edit(Film $film): Film;

    public function delete(Film $film): bool;
}
