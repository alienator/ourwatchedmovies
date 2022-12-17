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
}