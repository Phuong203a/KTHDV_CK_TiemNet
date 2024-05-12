<?php
require_once '../extensions/debug.php';
require_once 'db_connection.php';
$table_name = 'computer';
$col_id = "ID";
$col_name="name";
$col_serial = "serial";
$col_zone_id = "zone_id";


function insertComputer($name, $serial, $zone_id)
{
    global $table_name, $col_id, $col_name, $col_serial, $col_zone_id;
    $conn = getConnection();

    $sql = "INSERT INTO $table_name ($col_name, $col_serial, $col_zone_id)
    VALUES ('$name', '$serial', $zone_id)";

    $result = $conn->query($sql);
    // Đóng kết nối
    $conn->close();
    if ($result === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function updateComputer($id, $name, $serial, $zone_id)
{
    global $table_name, $col_id, $col_name, $col_serial, $col_zone_id;
    $conn = getConnection();

    $sql = "UPDATE $table_name SET $col_name = '$name', $col_serial = '$serial', $col_zone_id = $zone_id WHERE $col_id = $id";
    echo($sql);


    $result = $conn->query($sql);
    // Đóng kết nối
    $conn->close();
    if ($result === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function getAllComputer()
{
    global $table_name, $col_id, $col_name, $col_serial, $col_zone_id;
    $conn = getConnection();

    $sql = "SELECT * FROM $table_name";
    $result = $conn->query($sql);
    return $result;
}

function getComputerByID($id)
{
    global $table_name, $col_id, $col_name, $col_serial, $col_zone_id;
    $conn = getConnection();
    $sql = "SELECT * FROM $table_name WHERE $col_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    }
    return null;
}

function deleteComputer($ID)
{
    global $table_name, $col_id, $col_name, $col_serial, $col_zone_id;
    $conn = getConnection();

    $sql = "DELETE FROM $table_name WHERE $col_id = $ID";
    if ($conn->query($sql) === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

?>