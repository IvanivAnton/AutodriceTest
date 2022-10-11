<?php

namespace App\Helpers;

class Str
{
    public function strContains(string $haystack, string $needle): bool
    {
        return strpos($haystack, $needle) !== false;
    }
}
