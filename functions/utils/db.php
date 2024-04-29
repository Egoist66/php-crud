<?php
function db(string $dbname): PDO|null
{
    try {
        $connect = new PDO('mysql:host=localhost;dbname=' . $dbname, 'root', '');
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        echo "<script>
                console.log('Connected to database');
   
            </script>";
        return $connect;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo "<script>
                console.log(`{$error}`);
   
            </script>";

        return null;
    }
}