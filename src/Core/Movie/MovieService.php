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

        if (empty($movie->getId())) {
            $movie = $this->remoteRepository->findById($id);
        }

        return $movie;
    }

    public function add(Movie $movie): string
    {
       $this->localRepository->save($movie);
       return $this->localRepository->getLastInsertedId();
    }

    public function findLocal($criteria)
    {
        return $this->localRepository->find($criteria);
    }

    public function findRemote($criteria)
    {
        return $this->remoteRepository->find($criteria);
    }
}
