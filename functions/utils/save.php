<?php
/** Makes a new SQL query to save data
 * @param string $table
 * @param array $data
 * @return bool
 */
function save(string $table = '', array $data = []): bool
{

    global $connect;
    try {
        $sql = 'INSERT INTO ' . $table . ' (' . implode(',', array_keys($data)) . ') VALUES (' . implode(',', array_fill(0, count($data), '?')) . ')';
        $stmt = $connect->prepare($sql);
        $stmt->execute(array_values($data));
        return true;
    }
    catch (PDOException $e) {
        if($e->getCode() === '23000'){
            echo "<div class='alert text-center alert-danger'>Registration failed! Such email already exists</div>";
        }
        return false;
    }
}