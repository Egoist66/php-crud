<?php
namespace App\Services;


use App\Controllers\AppController;

class AppService extends Service
{

    public static function init(): void
    {
        AppController::init();
    }
}