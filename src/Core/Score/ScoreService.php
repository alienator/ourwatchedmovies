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
}
