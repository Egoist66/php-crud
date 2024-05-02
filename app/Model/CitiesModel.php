<?php

namespace App\Model;

class CitiesModel
{

    public static function getCities(int $start, int $per_page): array|false
    {

        $stmt = DBConnect->query("SELECT * FROM city LIMIT $start, $per_page ");
        return $stmt->findAll();

    }

    public static function getCitiesCount(): int
    {
        return DBConnect
            ?->query('SELECT COUNT(*) FROM city')
            ?->findColumn();
    }

    /**
     * @throws \JsonException
     */
    public static function addCity(array $data): bool|string
    {
        if($data){
            DBConnect
                ?->query('INSERT INTO city (`name`, `population`) VALUES (?, ?)', [
                    $data['cityname'],
                    $data['citypopulation']
                ]);


            return json_encode([
                "message" => "City added successfully",
                "total" =>  self::getCitiesCount(),
            ], JSON_THROW_ON_ERROR);


        }

        return false;
    }
}