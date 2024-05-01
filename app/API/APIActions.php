<?php

namespace App\API;

use App\Model\CitiesModel;
use Classes\Pagination;
use JetBrains\PhpStorm\NoReturn;
use JsonException;
use const App\Controllers\PER_PAGE;

class APIActions
{

    /**
     * @throws JsonException
     */
    #[NoReturn] final public static function action(): void
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
            if (isset($data['page'])) {
                $page = (int)$data['page'];
                $per_page = PER_PAGE;
                $total = TOTAL;

                $pagination = new Pagination($page, $per_page, $total);
                $start = $pagination->get_start();
                $cities = CitiesModel::getCities($start, $per_page);

                view('components->cities-table', [
                    'cities' => $cities,
                    'pagination' => $pagination,
                    "ui" => [
                        "controls" => view('components->controls', [
                            "cityModal" => view('components->add-city-modal')->render(),
                            "deleteCityModal" => view('components->delete-city-modal')->render(),
                            "editCityModal" => view('components->edit-city-modal')->render()
                        ])->render(),
                    ]
                ]);

                die();
            }


        } catch (\RuntimeException $e) {
            echo "Something went wrong: " . $e->getMessage();
        }
    }

}