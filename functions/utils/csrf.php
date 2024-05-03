<?php

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

// This code defines a function called csrf_field that generates a hidden input field with a CSRF token. If the CSRF token is not set in the session, it generates a new one using random_bytes and stores it in the session. The function then returns the HTML for the hidden input with the CSRF token value.


function csrf_field(): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $csrf_token = $_SESSION['csrf_token'] ?? bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;

    return '<input type="hidden" name="csrf_token" value="' . $csrf_token . '">';
}

function validate_csrf(): void
{

    if (!isset($_SESSION['csrf_token']) || !isset($_POST['csrf_token']) || $_SESSION['csrf_token'] !== $_POST['csrf_token'])
    {
        session_destroy();
        header('Location: /');
        die();
    }
}

function generate_csrf_token()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $csrf_token = $_SESSION['csrf_token'] ?? bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;

    return $csrf_token;
}

function validate_csrf_token_with_header(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    // Проверка токена
    $csrf_token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    $stored_token = $_SESSION['csrf_token'] ?? '';

    if (empty($csrf_token) || empty($stored_token) || $csrf_token !== $stored_token) {
        // Неверный CSRF-токен
        header('HTTP/1.1 403 Forbidden');
        exit();
    }

    // Генерация нового токена
    $new_token = generate_csrf_token();

    // Удаление текущего токена из сессии
   unset($_SESSION['csrf_token']);


    // Отправка ответа с заголовком X-CSRF-Token
    header('X-CSRF-Token: ' . $new_token);

    // Обработка запроса и отправка данных клиенту
    // ...
}