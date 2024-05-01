<?php


function prevent_fav(): void
{

    if (str_contains($_SERVER['REQUEST_URI'], 'favicon.ico')) {
        header('HTTP/1.1 204 No Content');
        exit;
    }


}