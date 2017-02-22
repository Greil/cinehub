<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 14:51
 */

namespace Actor\Service;

use Actor\Entity\Actor;

interface ActorServiceInterface
{
    /**
     * @return Actor[]
     */
    public function getAllActors();

    /**
     * @param int $id
     *
     * @return Actor|null
     */
    public function getActorById(int $id): Actor;

    public function create(Actor $actor): Actor;

    public function edit(Actor $actor): Actor;

    public function delete(Actor $actor): bool;
}
