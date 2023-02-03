<?php

/**
 * Test MoviesService
 */

declare(strict_types=1);

use Core\Movie\Movie;
use PHPUnit\Framework\TestCase;

use Core\Movie\MovieLocalRepository;
use Core\Movie\MovieRemoteRepository;
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
        $mockLocalRepository = $this->getMockBuilder(MovieLocalRepository::class)
            ->getMock();
        $mockLocalRepository->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn(NULL);

        $mockRemoteRepository = $this->getMockBuilder(MovieRemoteRepository::class)
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
        $mockLocalRepository = $this->getMockBuilder(MovieLocalRepository::class)
            ->getMock();
        $mockLocalRepository->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn($expected);

        $mockRemoteRepository = $this->getMockBuilder(MovieRemoteRepository::class)
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
        $mockLocalRepository = $this->getMockBuilder(MovieLocalRepository::class)
            ->getMock();
        $mockLocalRepository->expects($this->once())
            ->method('find')
            ->with($criteria)
            ->willReturn($expectedLocalMovies);

        $mockRemoteRepository = $this->getMockBuilder(MovieRemoteRepository::class)
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

    public function test_it_should_add_a_movie_to_local_no_comments_or_score()
    {
        // Given
        $movie = new Movie(
            0,
            'tit',
            'something',
            '2002-2-2',
            'img.png',
            6.6,
            'http://',
            '',
            0.0
        );


        // Expect
        $mockLocalRepository = $this->getMockBuilder(MovieLocalRepository::class)
            ->getMock();
        $mockLocalRepository->expects($this->once())
            ->method('save')
            ->with($movie);

        $mockRemoteRepository = $this->getMockBuilder(MovieRemoteRepository::class)
            ->getMock();

        // When
        $movieServiceUnderTest = new MovieService(
            $mockLocalRepository,
            $mockRemoteRepository
        );

        $movieServiceUnderTest->add(
            $movie
        );
    }

    public function test_it_should_find_only_in_local()
    {
        // Given
        $criteria = 'something';

        // Expect
        $mockLocal = $this->getMockBuilder(MovieLocalRepository::class)
            ->getMock();

        $mockLocal->expects($this->once())
            ->method('find')
            ->with($criteria);

        $mockRemote = $this->getMockBuilder(MovieRemoteRepository::class)
            ->getMock();

        $mockRemote->expects($this->never())
            ->method('find');

        // When
        $movieService = new MovieService($mockLocal, $mockRemote);
        $movieService->findLocal($criteria);
    }

    public function test_it_should_find_only_in_remote()
    {
        // Given
        $criteria = 'something';

        // Expect
        $expected = [
            new Movie(1, 'tit', 'desc', '200', 'image.png', 5, 'link', '', 0),
            new Movie(1, 'tit', 'desc', '200', 'image.png', 5, 'link', '', 0),
        ];

        $mockRemote = $this->getMockBuilder(MovieRemoteRepository::class)
            ->getMock();

        $mockRemote->expects($this->once())
            ->method('find')
            ->with($criteria)
            ->willReturn($expected);

        $mockLocal = $this->getMockBuilder(MovieLocalRepository::class)
            ->getMock();

        $mockLocal->expects($this->never())
            ->method('find');

        // When
        $movieService = new MovieService($mockLocal, $mockRemote);
        $res = $movieService->findRemote($criteria);
        $this->assertEquals($expected, $res);
        $this->assertEquals($expected[0]->getId(), $res[0]->getId());
        
    }

    public function test_it_should_return_ID_when_movie_is_inserted_to_local()
    {
        // Given
        $movie = new Movie(
            0,
            'title',
            'summary',
            '200-01-01',
            'cover.png',
            5,
            'http://',
            '2020-05-05',
            8
        );

        // Expect
        $mockLocalRepository = $this->getMockBuilder(MovieLocalRepository::class)
            ->getMock();
        $mockLocalRepository->expects($this->once())
            ->method('save')
            ->with($movie);
        $mockLocalRepository->expects($this->once())
            ->method('getLastInsertedId')
            ->willReturn(1001);

        $mockRemoteRepository = $this->getMockBuilder(MovieRemoteRepository::class)
            ->getMock();

        // When
        $movieService = new MovieService(
            $mockLocalRepository,
            $mockRemoteRepository
        );

        $newId = $movieService->add($movie);

        // Then
        $this->assertTrue(($newId > 0));
    }
}
