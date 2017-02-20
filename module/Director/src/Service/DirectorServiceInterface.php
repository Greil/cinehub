<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 14:51
 */

namespace Director\Service;

use Director\Entity\Director;

interface DirectorServiceInterface
{
    /**
     * @return Director[]
     */
    public function getAllDirectors();

    /**
     * @param int $id
     *
     * @return Director|null
     */
    public function getDirectorById(int $id): Director;

    public function create(Director $director): Director;

    public function edit(Director $director): Director;

    public function delete(Director $director): bool;
}
