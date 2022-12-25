<?php

/**
 * Movie entity
 */

declare(strict_types=1);

namespace Core\Movie;

class Movie
{
    private int $id;
    private string $title;
    private string $summary;
    private string $releaseDate;
    private string $imagePath;
    private float $globalScore;
    private string $moreInfo;
    private string $watchedDate;
    private float $ourScore;

    public function __construct(
        int    $id          = 0,
        string $title       = '',
        string $summary     = '',
        string $releaseDate = '',
        string $imagePath   = '',
        float  $globalScore = 0.0,
        string $moreInfo    = '',
        string $watchedDate = '',
        float  $ourScore    = 0.0
    ) {
        $this->id          = $id;
        $this->title       = $title;
        $this->summary     = $summary;
        $this->releaseDate = $releaseDate;
        $this->imagePath   = $imagePath;
        $this->globalScore = $globalScore;
        $this->moreInfo    = $moreInfo;
        $this->watchedDate = $watchedDate;
        $this->ourScore    = $ourScore;
    }

    public function setId($id) {
        $this->$id;
    }
}
