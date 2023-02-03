<?php

/**
 * Interface Movie Repository
 */

declare(strict_types=1);

namespace Core\Movie;

use Core\Movie\MovieRemoteRepository;

interface MovieLocalRepository extends MovieRemoteRepository
{
    public function save(Movie $movie);
    public function getLastInsertedId(): int;
}
