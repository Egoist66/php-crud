<?php
namespace App\Services;


use App\API\APIActions;

class APIActionsService extends Service
{

    public static function init(): void
    {
        APIActions::action();

    }
}