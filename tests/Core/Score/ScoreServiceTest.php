<?php

/**
 * Score service test
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Core\Score\Score;
use Core\Score\ScoreRepository;
use Core\Score\ScoreService;
use PHPUnit\Framework\MockObject\MockObject;

final class ScoreServiceTest extends TestCase
{
    /**
     * @var ScoreRepository&MockObject
     */
    private MockObject $mockRepository;

    private ScoreService $serviceUnderTest;

    public function setup(): void
    {
        $this->mockRepository = $this->createMock(ScoreRepository::class);
        $this->serviceUnderTest = new ScoreService($this->mockRepository);
    }
    
    public function test_it_should_save_a_score()
    {
        // Given
        $score = new Score(0, 'AABB11', 1, 5.5, '2002-2-2');

        // Expect
        $this->mockRepository->expects($this->once())
            ->method('save')
            ->with($score);

        // When
        $this->serviceUnderTest->save($score);
    }

    public function test_it_should_find_scores_by_movie_id()
    {
        // Given
        $expected = [
            new Score(1, 'AAA', 1, 4.5, '2000'),
            new Score(1, 'AAA', 1, 4.5, '2000'),
            new Score(1, 'AAA', 1, 4.5, '2000')
        ];

        $movieId = 'AAA';

        $this->mockRepository->expects($this->once())
            ->method('findByMovieId')
            ->with($movieId)
            ->willReturn($expected);

        // When
        $actual = $this->serviceUnderTest->findByMovieId($movieId);
        
        // Then
        $this->assertEquals($expected, $actual);
    }

    public function test_it_should_find_a_score_by_id()
    {
        // Given
        $expected = new Score(1, 'AAA', 1, 4.5, '2000');

        $scoreId = 1;

        $this->mockRepository->expects($this->once())
            ->method('findById')
            ->with($scoreId)
            ->willReturn($expected);

        // When
        $actual = $this->serviceUnderTest->findById($scoreId);
        
        // Then
        $this->assertEquals($expected, $actual);
    }
}
