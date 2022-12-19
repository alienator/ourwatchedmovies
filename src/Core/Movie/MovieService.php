<?php

/**
 * Movie Service
 */

declare(strict_types=1);

namespace Core\Movie;

class MovieService
{
    private $localRepository;
    private $remoteRepository;

    public function __construct($localRepository, $remoteRepository)
    {
        $this->localRepository = $localRepository;
        $this->remoteRepository = $remoteRepository;
    }

    public function find($criteria)
    {
        return array_merge(
            $this->localRepository->find($criteria),
            $this->remoteRepository->find($criteria)
        );
    }

    public function findById($id)
    {
        $movie = $this->localRepository->findById($id);

        if ($movie === NULL) {
            $movie = $this->remoteRepository->findById($id);
        }

        return $movie;
    }

    public function add(Movie $movie): void
    {
        $this->localRepository->save($movie);
    }
}
