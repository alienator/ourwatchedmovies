<?php

/**
 * Factory of Movies
 */

declare(strict_types=1);

namespace Tests\Core\Movie;

use Core\Movie\Movie;

class MovieFactory
{
    public static function createArray(): array
    {
        $movies = array();

        $movies[] = new Movie(
            1,
            'title1',
            'Lorem ipsum dolor sit amet',
            '/images/movie1.jpg',
            '2022-01-01',
            7.8,
            'http://link-more-info.com',
            '2022-02-01',
            6.2
        );

        $movies[] =  new Movie(
            2,
            'title2',
            'Lorem ipsum dolor sit amet',
            '/images/movie1.jpg',
            '2022-01-01',
            7.8,
            'https://inmdb.com/some-movie',
            '2022-02-01',
            6.2
        );

        $movies[] =  new Movie(
            3,
            'title3',
            'Lorem ipsum dolor sit amet',
            '/images/movie1.jpg',
            '2022-01-01',
            7.8,
            'http://movies.com',
            '2022-02-01',
            6.2
        );

        return $movies;
    }

    public static function createOne()
    {
        return new Movie(
            1,
            'title',
            'Lorem ipsum dolor sit amet',
            '/images/movie1,jpg',
            '2022-01-01',
            6.2,
            'http://link-more-info.com',
            '2022-02-01',
            2.2
        );
    }
}
