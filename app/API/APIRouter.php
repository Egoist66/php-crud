<?php

namespace App\API;

use App\Services\Service;

class APIRouter extends Service
{

    public static function init(): void
    {
       if(request()){
           $action = $_GET['paginate'];
           if ($action === 'cities') {
               APIActions::action();
           }
       }
    }
}