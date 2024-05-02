<?php
namespace App\Services;


use App\API\APIActions;
use App\API\APIRouter;
use JsonException;

class APIActionsService extends Service
{

    /**
     * @throws JsonException
     */
    public static function init(): void
    {
        APIRouter::init();

    }
}