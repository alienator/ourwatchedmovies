<?php

/**
 * Score entity
 */

declare(strict_types=1);

namespace Core\Score;

class Score
{
    private int $id;
    private string $movieId;
    private int $userId;
    private float $value;
    private string $modificationDate;

    public function __construct(
        int $id,
        string $movieId,
        int $userId,
        float $value,
        string $modificationDate
    ) {
        $this->id           = $id;
        $this->movieId      = $movieId;
        $this->userId       = $userId;
        $this->value        = $value;
        $this->modificationDate = $modificationDate;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setMovieId(string $id)
    {
        $this->movieId = $id;
    }

    public function getMovieId(): string
    {
        return $this->movieId;
    }
    
    public function setUserId($id)
    {
        $this->userId = $id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
    
    public function setModificationDate($date)
    {
        $this->modificationDate = $date;
    }

    public function getModificationDate()
    {
        return $this->modificationDate;
    }
    
}
