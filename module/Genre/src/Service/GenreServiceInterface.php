<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 11:15
 */

namespace Genre\Service;


use Genre\Entity\Genre;

interface GenreServiceInterface
{
    /**
     * @return Genre[]
     */
    public function getAllGenres();

    /**
     * @param int $id
     *
     * @return Genre|null
     */
    public function getGenreById(int $id): Genre;

    public function create(Genre $genre): Genre;

    public function edit(Genre $genre): Genre;

    public function delete(Genre $genre): bool;
}
