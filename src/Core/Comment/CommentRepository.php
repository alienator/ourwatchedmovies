<?php
/**
 * Comment Repository interface
 */

namespace Core\Comment;

use Core\Comment\Comment;

interface CommentRepository
{
    public function save(Comment $comment): void;

    /**
     * @return array of comemtns if any, or empty array if none
     */
    public function findByMovieId(string $movieId): array;

    public function findById(int $id): Comment;
}
