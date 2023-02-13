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
    private string $imagePath;
    private bool $disable;

    public function __construct($id = 0, $name = '', $email = '', $imagePath = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->imagePath = $imagePath;
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

    public function setImagePath(string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
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
