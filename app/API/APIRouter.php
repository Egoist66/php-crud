<?php

namespace App\API;

use App\Services\Service;
use JsonException;

class APIRouter extends Service
{

    /**
     * @throws JsonException
     */
    public static function init(): void
    {
       if(request('post') && $_SERVER['REQUEST_URI'] === '/api/cities') {
           APIActions::getCities();
       }

       if(request('post') && $_SERVER['REQUEST_URI'] === '/api/cities/add') {
           APIActions::createCity();
       }

       if(request() && str_contains($_SERVER['REQUEST_URI'], '/api/cities/show')) {
           APIActions::editCity();
       }

       if(request('put') && $_SERVER['REQUEST_URI'] === "/api/cities/edit/") {
           APIActions::updateCity();
       }
    }
}