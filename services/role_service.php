<?php
require_once 'db_connection.php';
$table_name = 'role';
$col_id = "ID";
$col_name="name";


function insertRole($name)
{
    global $table_name, $col_id, $col_name;
    $conn = getConnection();

    $sql = "INSERT INTO $table_name ($col_name)
    VALUES ('$name')";

    $result = $conn->query($sql);
    // Đóng kết nối
    $conn->close();
    if ($result === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function updateRole($id, $name)
{
    global $table_name, $col_id, $col_name;
    $conn = getConnection();

    $sql = "UPDATE $table_name SET $col_name = '$name' WHERE $col_id = $id";

    $result = $conn->query($sql);
    // Đóng kết nối
    $conn->close();
    if ($result === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function getAllRole()
{
    global $table_name, $col_id, $col_name;
    $conn = getConnection();
    $sql = "SELECT * FROM $table_name";
    $result = $conn->query($sql);
    return $result;
}

function getRoleByID($id)
{
    global $table_name, $col_id, $col_name;
    $conn = getConnection();
    $sql = "SELECT * FROM $table_name WHERE $col_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    }
    return null;
}

function deleteRole($ID)
{
    global $table_name, $col_id, $col_name;
    $conn = getConnection();
    $sql = "DELETE FROM $table_name WHERE $col_id = $ID";
    if ($conn->query($sql) === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

?>