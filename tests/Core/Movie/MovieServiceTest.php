<?php

/**
 * Test MoviesService
 */

declare(strict_types=1);

use Core\Movie\Movie;
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
        $mockLocalRepository = $this->getMockBuilder(MovieRepository::class)
            ->getMock();
        $mockLocalRepository->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn(NULL);

        $mockRemoteRepository = $this->getMockBuilder(MovieRepository::class)
            ->getMock();
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
        $mockLocalRepository = $this->getMockBuilder(MovieRepository::class)
            ->getMock();
        $mockLocalRepository->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn($expected);

        $mockRemoteRepository = $this->getMockBuilder(MovieRepository::class)
            ->getMock();

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
        $mockLocalRepository = $this->getMockBuilder(MovieRepository::class)
            ->getMock();
        $mockLocalRepository->expects($this->once())
            ->method('find')
            ->with($criteria)
            ->willReturn($expectedLocalMovies);

        $mockRemoteRepository = $this->getMockBuilder(MovieRepository::class)
            ->getMock();
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

    public function test_it_should_add_a_movie_to_local_with_no_comments_or_score()
    {
        // Given
        $movie = new Movie(
            0,
            'tit',
            'something',
            '2002-2-2',
            'img.png',
            6.6,
            '',
            0.0
        );


        // Expect
        $mockLocalRepository = $this->getMockBuilder(MovieRepository::class)
            ->getMock();
        $mockLocalRepository->expects($this->once())
            ->method('save')
            ->with($movie);

        $mockRemoteRepository = $this->getMockBuilder(MovieRepository::class)
            ->getMock();
        $mockRemoteRepository->expects($this->never())
            ->method('save');

        // When
        $movieServiceUnderTest = new MovieService(
            $mockLocalRepository,
            $mockRemoteRepository
        );

        $movieServiceUnderTest->add(
            $movie
        );
    }
}
