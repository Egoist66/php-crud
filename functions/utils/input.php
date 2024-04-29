<?php


function input(array $attrs, array $required = []): array|null


{

    try {
        $result = [];

        foreach ($required as $key) {
            if (!array_key_exists($key, $attrs) || empty($_POST[$key])) {
                throw new \RuntimeException(
                    "<div class='alert alert-danger rounded' style='text-align: center'>Field $key is required!</div>"
                );
            }
        }

        foreach ($attrs as $key => $type) {

            if (!array_key_exists($key, $_POST)) {
                throw new \RuntimeException("Key {$key} does not exist!");
            }

            if (gettype($_POST[$key]) !== $type) {
                throw new \RuntimeException("Wrong input type for {$key}. Expected" . ' ' . gettype($_POST[$key]) . " instead of " . $type);
            }

            $result[$key] = sanitize($_POST[$key]);


        }
        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
        return null;
    }
}
