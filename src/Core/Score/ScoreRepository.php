<?php

/**
 * Score repository interface
 */

declare(strict_types=1);

namespace Core\Score;

use Core\Score\Score;

interface ScoreRepository
{
    public function save(Score $score): void;

    public function findByMovieId(string $movieId): array;

    public function findById(int $id): Score;
}
