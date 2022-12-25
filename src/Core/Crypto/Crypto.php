<?php
/**
 * Crypto interface
 */

namespace Core\Crypto;

interface Crypto
{
    public function hash(string $txt): string;
}
