<?php

function dump(mixed $data, bool $die = false): void
{
    if (!$data) {
        return;
    }
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if ($die) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die();
    }
}