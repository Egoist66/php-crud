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
}