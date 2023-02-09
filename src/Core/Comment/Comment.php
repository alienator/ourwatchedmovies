<?php
/**
 * Comment entity
 */

declare(strict_types=1);

namespace Core\Comment;

class Comment
{
    private int $id;
    private string $movieId;
    private int $userId;
    private string $text;
    private string $creationDate;

    public function __construct(
        int $id,
        string $movieId,
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

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setMovieId(string $id)
    {
        $this->movieId = $id;
    }

    public function getMovieId(): string
    {
        return $this->movieId;
    }

    public function setUserId($id)
    {
        $this->userId = $id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setComment($comment)
    {
        $this->text = $comment;
    }

    public function getComment()
    {
        return $this->text;
    }

    public function setCreationDate($date)
    {
        $this->creationDate = $date;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }
}
