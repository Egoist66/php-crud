<?php
require_once  '../vendor/autoload.php';

use App\Model\CitiesModel;
use Classes\DB;
use Classes\Pagination;

define('DBConnect', DB::getInstance()?->setConnection(
    require __DIR__ . '/Traits/db-config.php'));

define('TOTAL', CitiesModel::getCitiesCount());
define('PAGE', (isset($_GET['page']) ? (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1 : 1));
const PER_PAGE = 10;




$pagination = new Pagination(PAGE, PER_PAGE, TOTAL);
$start = $pagination->get_start();

define('CITIES', CitiesModel::getCities($start, PER_PAGE));
