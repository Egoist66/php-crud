<?php

namespace App\Traits;

use PDO;

trait DBConnection
{
    public static function connect(): null | PDO{
        return db('world_cities');
    }

}