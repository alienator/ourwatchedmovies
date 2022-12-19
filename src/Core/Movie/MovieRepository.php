<?php

/**
 * Interface Movie Repository
 */

declare(strict_types=1);

namespace Core\Movie;

interface MovieRepository
{
    public function find(string $criteria);
    public function findById(int $id);
    public function save(Movie $movie);
}
