<?php
/**
 * Comment service test
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Core\Comment\Comment;
use Core\Comment\CommentRepository;
use Core\Comment\CommentService;

final class CommentServiceTest extends TestCase
{
    public function test_it_should_add_a_comment()
    {
        // Given
        $comment = new Comment(0, 1, 1, 'some comment', '2002-2-2');

        // Expect
        $mockCommentRepository = $this->getMockBuilder(CommentRepository::class)
                                      ->getMock();
        $mockCommentRepository->expects($this->once())
                              ->method('save')
                              ->with($comment);

        // When
        $commentServiceUnderTest = new CommentService($mockCommentRepository);
        $commentServiceUnderTest->add($comment);
    }
}
