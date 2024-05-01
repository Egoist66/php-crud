<?php
require_once  '../vendor/autoload.php';


use App\API\APIRouter;
use App\Services\APIActionsService;
use App\Services\AppService;

$services = [
    AppService::class,
    APIRouter::class
];

foreach ($services as $service) {
    $service::init();
}