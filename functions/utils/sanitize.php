<?php


function sanitize(string $data): string
{
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return trim($data);
}
