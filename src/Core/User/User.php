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
    private bool $disable;

    public function __construct($id = 0, $name = '', $email = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->disable = false;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    
    public function disable()
    {
        $this->disable = true;
    }

    public function isDisable()
    {
        return $this->disable;
    }
}
