<?php
/**
 * Session helper
 */

namespace Core\Auth;

interface SessionHelper
{
    public function createToken(string $txt): string;
}
   
