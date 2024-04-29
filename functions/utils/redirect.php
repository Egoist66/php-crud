<?php


/**
 * Redirects to a specified URL.
 *
 * @param string $url The URL to redirect to.
 * @param int $httpResponseCode The HTTP response code to send (default: 303).
 * @return void
 */
function redirect(string $url, int $httpResponseCode = 303): void
{
    header('Location: ' . $url, $httpResponseCode);
    exit();
}

