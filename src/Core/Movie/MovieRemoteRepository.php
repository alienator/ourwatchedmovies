<?php

/**
 * Interface Movie Remote Repository
 */

declare(strict_types=1);

namespace Core\Movie;

interface MovieRemoteRepository
{
    public function find(string $criteria);
    public function findById(string $id);
}
