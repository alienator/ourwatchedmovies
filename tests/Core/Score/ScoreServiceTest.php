<?php

/**
 * Score service test
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Core\Score\Score;
use Core\Score\ScoreRepository;
use Core\Score\ScoreService;

final class ScoreServiceTest extends TestCase
{
    public function test_it_should_add_a_score()
    {
        // Given
        $score = new Score(0, 1, 1, 5.5, '2002-2-2');

        // Expect
        $mockScoreRepository = $this->getMockBuilder(ScoreRepository::class)
            ->getMock();
        $mockScoreRepository->expects($this->once())
            ->method('save')
            ->with($score);

        // When
        $scoreServiceUnderTest = new ScoreService($mockScoreRepository);
        $scoreServiceUnderTest->add($score);
    }
}