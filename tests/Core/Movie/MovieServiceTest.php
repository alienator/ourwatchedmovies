<?php

/**
 * Test MoviesService
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Core\Movie\Movie;
use Core\Movie\MovieRepository;
use Core\Movie\MovieService;

final class MovieServiceTest extends TestCase
{
    public function test_it_can_find_all_movies_given_a_criteria()
    {
        // Given
        $criteria = 'title';

        $expectedLocalMovies = array(
            new Movie(
                1,
                'title1',
                'Lorem ipsum dolor sit amet',
                '/images/movie1.jpg',
                '2022-01-01',
                7.8,
                '2022-02-01',
                6.2
            ),
            new Movie(
                2,
                'title2',
                'Lorem ipsum dolor sit amet',
                '/images/movie1.jpg',
                '2022-01-01',
                7.8,
                '2022-02-01',
                6.2
            ),
            new Movie(
                3,
                'title3',
                'Lorem ipsum dolor sit amet',
                '/images/movie1.jpg',
                '2022-01-01',
                7.8,
                '2022-02-01',
                6.2
            ),
        );

        $expectedRemoteMovies = array(
            new Movie(
                0,
                'title',
                'Lorem ipsum dolor sit amet',
                '/images/movie1.jpg',
                '2022-01-01',
                6.8,
                '',
                0
            )
        );

        $expectedMovies = array_merge(
            $expectedLocalMovies,
            $expectedRemoteMovies
        );

        // Expect
        $mockLocalRepository = $this->createMock(MovieRepository::class);
        $mockLocalRepository->expects($this->once())
            ->method('find')
            ->with($criteria)
            ->willReturn($expectedLocalMovies);

        $mockRemoteRepository = $this->createMock(MovieRepository::class);
        $mockRemoteRepository->expects($this->once())
            ->method('find')
            ->with($criteria)
            ->willReturn($expectedRemoteMovies);

        // When
        $movieServiceUnderTest = new MovieService(
            $mockLocalRepository,
            $mockRemoteRepository
        );
        $actualMovies = $movieServiceUnderTest->find($criteria);

        // Then
        $this->assertEquals($expectedMovies, $actualMovies);
    }
}
