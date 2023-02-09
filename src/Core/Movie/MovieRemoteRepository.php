<?php

/**
 * Interface Movie Remote Repository
 */

declare(strict_types=1);

namespace Core\Movie;

interface MovieRemoteRepository
{
    /**
     * @return array of Movies
     */
    public function find(string $criteria): array;

    /**
     * @return a Movie
     */
    public function findById(string $id): Movie; 
}
