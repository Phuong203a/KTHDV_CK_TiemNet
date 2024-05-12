<?php
require_once 'db_connection.php';
$table_name = 'zone';
$col_id = "ID";
$col_name="name";
$col_price_per_hour = "price_per_hour";
$col_keyboard = "keyboard";
$col_mouse = "mouse";
$col_headphone="headphone";
$col_cpu = "CPU";
$col_ram = "RAM";
$col_card = "Card";
$col_chair = "Chair";


function insertZone($name, $price_per_hour, $keyboard, $mouse,$headphone,$cpu,$ram,$card,$chair)
{
    global $table_name, $col_id, $col_name, $col_price_per_hour, $col_keyboard, $col_mouse, $col_headphone, $col_cpu, $col_ram, $col_card, $col_chair;
    $conn = getConnection();

    $sql = "INSERT INTO $table_name ($col_name, $col_price_per_hour, $col_keyboard, $col_mouse, $col_headphone, $col_cpu, $col_ram, $col_card, $col_chair)
    VALUES ('$name', $price_per_hour, '$keyboard', '$mouse', '$headphone', '$cpu', '$ram', '$card', '$chair')";

    $result = $conn->query($sql);
    // Đóng kết nối
    $conn->close();
    if ($result === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function updateZone($id, $name, $price_per_hour, $keyboard, $mouse, $headphone, $cpu, $ram, $card, $chair)
{
    global $table_name, $col_id, $col_name, $col_price_per_hour, $col_keyboard, $col_mouse, $col_headphone, $col_cpu, $col_ram, $col_card, $col_chair;
    $conn = getConnection();

    $sql = "UPDATE $table_name SET $col_name = '$name', $col_price_per_hour = $price_per_hour, $col_keyboard = '$keyboard', $col_mouse = '$mouse', $col_headphone = '$headphone', $col_cpu = '$cpu', $col_ram = '$ram', $col_card = '$card', $col_chair = '$chair' WHERE $col_id = $id";

    $result = $conn->query($sql);
    // Đóng kết nối
    $conn->close();
    if ($result === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function getAllZone()
{
    global $table_name, $col_id, $col_name, $col_price_per_hour, $col_keyboard, $col_mouse, $col_headphone, $col_cpu, $col_ram, $col_card, $col_chair;
    $conn = getConnection();
    $sql = "SELECT * FROM $table_name";
    $result = $conn->query($sql);
    return $result;
}

function getZoneByID($id)
{
    global $table_name, $col_id, $col_name, $col_price_per_hour, $col_keyboard, $col_mouse, $col_headphone, $col_cpu, $col_ram, $col_card, $col_chair;
    $conn = getConnection();
    $sql = "SELECT * FROM $table_name WHERE $col_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    }
    return null;
}

function deleteZone($ID)
{
    global $table_name, $col_id, $col_name, $col_price_per_hour, $col_keyboard, $col_mouse, $col_headphone, $col_cpu, $col_ram, $col_card, $col_chair;
    $conn = getConnection();
    $sql = "DELETE FROM $table_name WHERE $col_id = $ID";
    if ($conn->query($sql) === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

?>