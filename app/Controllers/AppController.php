<?php

namespace App\Controllers;

use App\Model\CitiesModel;
use Classes\DB;
use Classes\Pagination;

final class AppController
{

    private static function setup(): void
    {
        define('DBConnect', DB::getInstance()?->setConnection(
            require __DIR__ . '/../Traits/db-config.php')
        );

        define('TOTAL', CitiesModel::getCitiesCount());
        define('PAGE', (isset($_GET['page']) ? (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1 : 1));
        define("App\Controllers\PER_PAGE", 10);


        define('PAGINATION',  new Pagination(PAGE, PER_PAGE, TOTAL));
        $start = PAGINATION->get_start();

        define('CITIES', CitiesModel::getCities($start, PER_PAGE));

    }

    final public static function init(): void
    {
        self::setup();

    }

}