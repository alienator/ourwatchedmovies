<?php
/**
 * Comment service
 */

namespace Core\Comment;

use Core\Comment\Comment;

class CommentService
{
    private CommentRepository $commentRepositroy;

    public function __construct($commentRepository)
    {
        $this->commentRepositroy = $commentRepository;
    }
    
    public function save(Comment $comment)
    {
        $this->commentRepositroy->save($comment);
    }
}
