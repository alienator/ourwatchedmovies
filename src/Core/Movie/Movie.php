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
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($tit) {
        $this->title = $tit;
    }

    public function getTitle()
    {
        return $this->title;
    }

   public function setSummary($summary) {
        $this->summary = $summary;
    }

    public function getSummary()
    {
        return $this->summary;
    } 

    public function setReleaseDate($date) {
        $this->releaseDate = $date;
    }

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public function setImagePath($image) {
        $this->imagePath = $image;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function setGlobalScore($score)
    {
        $this->globalScore = $score;
    }

    public function getGlobalScore()
    {
        return $this->globalScore;
    }

    public function setMoreInfo($info)
    {
        $this->moreInfo = $info;
    }

    public function getMoreInfo()
    {
        return $this->moreInfo;
    }

    public function setWatchedDate($date)
    {
        $this->watchedDate = $date;
    }

    public function getWatchedDate()
    {
        return $this->watchedDate;
    }

    public function setOurScore($score)
    {
        $this->ourScore = $score;
    }

    public function getOurScore()
    {
        return $this->ourScore;
    }
}
