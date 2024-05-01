<?php

function dump(mixed $data, bool $die = false): void
{
    if (!$data) {
        return;
    }
    if ($die) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die();
    }
    echo '<pre>';
    print_r($data);
    echo '</pre>';



}