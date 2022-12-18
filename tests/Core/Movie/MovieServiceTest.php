<?php

/**
 * Test MoviesService
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Core\Movie\MovieRepository;
use Core\Movie\MovieService;

use Tests\Core\Movie\MovieFactory;

final class MovieServiceTest extends TestCase
{
    public function test_it_should_find_one_remote_movie_by_id()
    {
        // Given
        $id = 1;

        $expected = MovieFactory::createOne();

        // Expect
        $mockLocalRepository = $this->createMock(MovieRepository::class);
        $mockLocalRepository->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn(NULL);

        $mockRemoteRepository = $this->createMock(MovieRepository::class);
        $mockRemoteRepository->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn($expected);

        // When
        $movieServiceUnderTest = new MovieService(
            $mockLocalRepository,
            $mockRemoteRepository
        );
        $actual = $movieServiceUnderTest->findById($id);

        // Then
        $this->assertEquals($expected, $actual);
    }

    public function test_it_should_find_one_local_movie_by_id()
    {
        // Given
        $id = 1;

        $expected = MovieFactory::createOne();

        // Expect
        $mockLocalRepository = $this->createMock(MovieRepository::class);
        $mockLocalRepository->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn($expected);

        $mockRemoteRepository = $this->createMock(MovieRepository::class);

        // When
        $movieServiceUnderTest = new MovieService(
            $mockLocalRepository,
            $mockRemoteRepository
        );
        $actual = $movieServiceUnderTest->findById($id);

        // Then
        $this->assertEquals($expected, $actual);
    }

    public function test_it_can_find_all_movies_given_a_criteria()
    {
        // Given
        $criteria = 'title';

        $expectedLocalMovies  = MovieFactory::createArray();
        $expectedRemoteMovies = MovieFactory::createArray();

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
