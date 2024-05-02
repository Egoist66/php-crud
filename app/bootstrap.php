<?php
require_once  '../vendor/autoload.php';


use App\Services\APIActionsService;
use App\Services\AppService;

$services = [
    AppService::class,
    APIActionsService::class
];

foreach ($services as $service) {
    $service::init();
}