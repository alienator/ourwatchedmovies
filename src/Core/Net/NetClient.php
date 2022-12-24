<?php
/**
 * Net client interface
 */

namespace Core\Net;
    
interface NetClient
{
    public function getIp(): string;
    public function getUserAgent(): string;
}
