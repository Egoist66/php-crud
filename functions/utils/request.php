<?php 

function request(string $method = 'get'): bool {
    return $_SERVER['REQUEST_METHOD'] === strtoupper($method) ? true : false;
}

