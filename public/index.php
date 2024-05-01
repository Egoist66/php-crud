<?php

use App\Controllers\AppController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../functions/functions.php';
require_once '../app/bootstrap.php';

prevent_fav();

$app = view('layout->main', [
    "parts" => [

        "header" => view(
            'layout/parts->header',
            ["title" => "Ajax and MySQL", "spinner" => view('components->spinner')->render()])->render(),

        "footer" => view('layout/parts->footer')->render(),
    ],

    "ui" => [
        "controls" => view('components->controls', [
            "cityModal" => view('components->add-city-modal')->render(),
            "deleteCityModal" => view('components->delete-city-modal')->render(),
            "editCityModal" => view('components->edit-city-modal')->render()
        ])->render(),

//        "cities" => view('components->cities-table', [
//               'pagination' => PAGINATION,
//                'cities' => CITIES
//       ])->render()
    ]
]);

