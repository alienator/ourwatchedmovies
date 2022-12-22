<?php

/**
 * User entity
 */

declare(strict_types=1);

namespace Core\User;

class User
{
    private int $id;
    private string $name;
    private string $email;

    public function __construct($id = 0, $name = '', $email = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
