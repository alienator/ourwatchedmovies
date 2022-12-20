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
}
