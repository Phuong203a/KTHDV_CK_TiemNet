<?php
require_once '../extensions/debug.php';
require_once 'db_connection.php';
$table_name = 'computer';
$col_id = "Id";
$col_name="Name";
$col_serial = "Serial";
$col_zone_id = "zone_id";
$col_status = "status";


function insertComputer($name, $serial, $zone_id, $status='')
{
    global $table_name, $col_id, $col_name, $col_serial, $col_zone_id,$col_status;
    $conn = getConnection();

    $sql = "INSERT INTO $table_name ($col_name, $col_serial, $col_zone_id, $col_status)
    VALUES ('$name', '$serial', $zone_id, '$status')";

    echo $sql;

    $result = $conn->query($sql);
    // Đóng kết nối
    $conn->close();
    if ($result === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function updateComputer($id, $name, $serial, $zone_id, $status = '')
{
    global $table_name, $col_id, $col_name, $col_serial, $col_zone_id,$col_status;
    $conn = getConnection();

    $sql = "UPDATE $table_name SET $col_name = '$name', $col_serial = '$serial', $col_zone_id = $zone_id, $col_status = '$status' WHERE $col_id = $id";


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
    global $table_name, $col_id, $col_name, $col_serial, $col_zone_id,$col_status;
    $conn = getConnection();

    $sql = "SELECT * FROM $table_name";
    $result = $conn->query($sql);
    return $result;
}

function getComputerByID($id)
{
    global $table_name, $col_id, $col_name, $col_serial, $col_zone_id,$col_status;
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
    global $table_name, $col_id, $col_name, $col_serial, $col_zone_id,$col_status;
    $conn = getConnection();

    $sql = "DELETE FROM $table_name WHERE $col_id = $ID";

    if ($conn->query($sql) === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

?>