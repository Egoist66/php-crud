<?php


function old(string $name): string
{
    static $storage = [];
    if (!empty($_POST[$name])) {
        $storage[$name] = $_POST[$name];
    }
    return htmlspecialchars($storage[$name]);
}
