<?php

namespace App\API;

use App\Model\CitiesModel;
use Classes\Pagination;
use Classes\Validator;
use JetBrains\PhpStorm\NoReturn;
use JsonException;
use const App\Controllers\PER_PAGE;

class APIActions
{

    /**
     * @throws JsonException
     */
    #[NoReturn] final public static function getCities(): void
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

                ]);

                die();
            }


        } catch (\RuntimeException $e) {
            echo "Something went wrong: " . $e->getMessage();
        }
    }

    /**
     * @throws JsonException
     */
    #[NoReturn] final public static function createCity(): void
    {
        $data = input([
            'cityname' => 'string',
            'citypopulation' => 'string',
            'addCity' => 'string',
        ], ['cityname', 'citypopulation', 'addCity']);


        if (count($data) > 0 && $data['addCity'] === '1') {
            $cities = CitiesModel::addCity($data);
            print_r($cities);

            die();
        }

    }

    /**
     * @throws JsonException
     */
    #[NoReturn] final public static function editCity(): void
    {
        $cityId = (int)$_GET['id'];

        $city = CitiesModel::getCity($cityId);
        echo $city;

        die();
    }

    /**
     * @throws JsonException
     */
    #[NoReturn] final public static function updateCity(): void
    {

        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['name']) || empty($data['population'])) {
            echo json_encode([
                'message' => 'Please fill all fields',
                'status' => 'error'
            ], JSON_THROW_ON_ERROR);
            die();
        }


        $response = CitiesModel::updateCity($data);
        echo $response;
        die();
    }

    /**
     * @throws JsonException
     */
    #[NoReturn] final public static function deleteCity(): void
    {

        $data = json_decode(file_get_contents("php://input"), true);
        $response = CitiesModel::deleteCity($data);
        echo $response;


        die();
    }


    /**
     * @throws JsonException
     */
    #[NoReturn] final public static function findCities(): void
    {

        $query = $_GET['q'] ?? '';
        $cities = CitiesModel::findCities($query);

        view('components->cities-table', [
            'cities' => $cities,
            'pagination' => PAGINATION,

        ]);

        die();
    }

}