<?php

namespace AskNicely\Services;

class Helper
{
    public static function toSnakeCase(string $string): string
    {
        $trimmed = trim($string);
        // Replace spaces with underscores and convert to lowercase
        return strtolower(str_replace(' ', '_', $trimmed));
    }
}