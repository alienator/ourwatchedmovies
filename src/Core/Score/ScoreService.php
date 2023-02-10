<?php

/**
 * Score ervice
 */

declare(strict_types=1);

namespace Core\Score;

class ScoreService
{
    private ScoreRepository $scoreRepository;

    public function __construct(ScoreRepository $scoreRepository)
    {
        $this->scoreRepository = $scoreRepository;
    }

    public function save(Score $score)
    {
        $this->scoreRepository->save($score);
    }

    public function findByMovieId(string $movieId): array
    {
        return $this->scoreRepository->findByMovieId($movieId);
    }

    public function findById(int $id): Score
    {
        return $this->scoreRepository->findById($id);
    }
}
