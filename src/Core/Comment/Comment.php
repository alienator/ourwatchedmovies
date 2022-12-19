<?php
/**
 * Comment entity
 */

declare(strict_types=1);

namespace Core\Comment;

class Comment
{
    private int $id;
    private int $movieId;
    private int $userId;
    private string $text;
    private string $creationDate;

    public function __construct(
        int $id,
        int $movieId,
        int $userId,
        string $text,
        string $creationDate
    )
    {
        $this->id           = $id;
        $this->movieId      = $movieId;
        $this->userId       = $userId;
        $this->text         = $text;
        $this->creationDate = $creationDate;
    }
}
