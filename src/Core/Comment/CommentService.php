<?php
/**
 * Comment service
 */

namespace Core\Comment;

use Core\Comment\Comment;

class CommentService
{
    private CommentRepository $commentRepositroy;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepositroy = $commentRepository;
    }
    
    public function save(Comment $comment)
    {
        $this->commentRepositroy->save($comment);
    }

    public function findByMovieId(string $movieId): array
    {
        return $this->commentRepositroy->findByMovieId($movieId);
    }

    public function findById(int $id): Comment
    {
        return $this->commentRepositroy->findById($id);
    }
}
