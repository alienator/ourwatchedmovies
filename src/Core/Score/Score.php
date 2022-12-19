<?php

/**
 * Score entity
 */

declare(strict_types=1);

namespace Core\Score;

class Score
{
    private int $id;
    private int $movieId;
    private int $userId;
    private float $value;
    private string $modifiedDate;

    public function __construct(
        int $id,
        int $movieId,
        int $userId,
        float $value,
        string $modifiedDate
    ) {
        $this->id           = $id;
        $this->movieId      = $movieId;
        $this->userId       = $userId;
        $this->value        = $value;
        $this->modifiedDate = $modifiedDate;
    }
}
