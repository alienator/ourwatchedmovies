<?php

/**
 * Comment service test
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Core\Comment\Comment;
use Core\Comment\CommentRepository;
use Core\Comment\CommentService;
use PHPUnit\Framework\MockObject\MockObject;

final class CommentServiceTest extends TestCase
{
    /**
     * @var CommentRepository&MockObject
     */
    private MockObject $mockRepository;

    private CommentService $serviceUnderTest;
    
    public function setup(): void
    {
        $this->mockRepository = $this->createMock(CommentRepository::class);
        $this->serviceUnderTest = new CommentService($this->mockRepository);
    }

    public function test_it_should_add_a_comment()
    {
        // Given
        $comment = new Comment(0, 'AABB11', 1, 'some comment', '2002-2-2');

        // Expect
        $this->mockRepository->expects($this->once())
            ->method('save')
            ->with($comment);

        // When
        $this->serviceUnderTest->save($comment);
    }

    public function test_it_should_find_all_comments_for_a_movie()
    {
        // Given
        $expected = [
            new Comment(1, 'AAA', 1, 'some comment', '200'),
            new Comment(2, 'AAA', 1, 'some comment', '200'),
            new Comment(3, 'AAA', 1, 'some comment', '200'),
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

    public function test_it_should_find_a_comment_by_id()
    {
        // Given
        $expected = new Comment(1, 'AAA', 1, 'some comment', '200');

        $commentId = 1;
                
        $this->mockRepository->expects($this->once())
            ->method('findById')
            ->with($commentId)
            ->willReturn($expected);

        // When
        $actual = $this->serviceUnderTest->findById($commentId);

        // Then
        $this->assertEquals($expected, $actual);
    }
}
