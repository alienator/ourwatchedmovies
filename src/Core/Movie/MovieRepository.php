<?php

/**
 * Interface Movie Repository
 */

declare(strict_types=1);

namespace Core\Movie;

interface MovieRepository
{
    public function find($criteria);
    public function findById($id);
}
