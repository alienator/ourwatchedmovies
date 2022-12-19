<?php
/**
 * Comment Repository interface
 */

namespace Core\Comment;

use Core\Comment\Comment;

interface CommentRepository
{
    public function save(Comment $comment): void;
}
