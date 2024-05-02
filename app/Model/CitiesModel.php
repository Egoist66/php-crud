<?php

namespace App\Model;

use JsonException;

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
     * @throws JsonException
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

    /**
     * @throws JsonException
     */
    public static function getCity(int $id): string {
        return json_encode([
            "id" => $id,
            "data" => DBConnect->query("SELECT * FROM city WHERE id = ?", [$id])->find()
        ], JSON_THROW_ON_ERROR);
    }

    /**
     * @throws JsonException
     */
    public static function updateCity(array $data): string {
        $name = sanitize($data['name']);
        $population = sanitize($data['population']);
        $id = sanitize($data['id']);


        DBConnect->query("UPDATE city SET name = ?, population = ? WHERE id = ?", [
            $name,
            $population,
            $id
        ]);

        return json_encode([
            "message" => "City updated successfully",
            "id" => $data['id'],
            "data" => DBConnect->query("SELECT * FROM city WHERE id = ?", [$id])->find()
        ], JSON_THROW_ON_ERROR);
    }
}