<?php
require_once 'db_connection.php';
$table_name = "useraccount";

$col_ID = "ID";
$col_name = "name";
$col_id_role = "id_role";
$col_phone_number = "phone_number";
$col_username = "username";
$col_password = "password";
$col_birthday = "birthday";
$col_balance = "balance";
$col_address = "address";
$col_email = "email";

function findAccountByUsernameAndPassword($username, $password) {
    global $table_name, $col_username, $col_password;
    $conn = getConnection();
    // Escape các ký tự đặc biệt để tránh tấn công SQL injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    $sql = "SELECT * FROM $table_name WHERE $col_username = '$username' AND $col_password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Tìm thấy tài khoản người dùng
        $row = $result->fetch_assoc();
        $conn->close();
        return $row;
    } else {

        $conn->close();
        return null;
    }
}

function insertAccount($name, $id_role, $phone_number, $username, $password, $birthday, $balance, $address, $email)
{
    global $table_name, $col_ID, $col_name, $col_id_role, $col_phone_number, $col_username, $col_password, $col_birthday, $col_balance, $col_address, $col_email;
    $conn = getConnection();
    $sql = "INSERT INTO $table_name ($col_name, $col_id_role, $col_phone_number, $col_username, $col_password, $col_birthday, $col_balance, $col_address, $col_email)
    VALUES ('$name', $id_role, '$phone_number', '$username', '$password', '$birthday', $balance, '$address', '$email')";
    $result = $conn->query($sql);
    // Đóng kết nối
    $conn->close();
    if ($result === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}
function updateAccount($ID, $name, $id_role, $phone_number, $username, $password, $birthday, $balance, $address, $email)
{
    global $table_name, $col_ID, $col_name, $col_id_role, $col_phone_number, $col_username, $col_password, $col_birthday, $col_balance, $col_address, $col_email;
    $conn = getConnection();

    $sql = "UPDATE $table_name SET $col_name='$name', $col_id_role='$id_role', $col_phone_number='$phone_number', $col_username='$username', $col_password='$password', $col_birthday='$birthday', $col_balance=$balance, $col_address='$address', $col_email='$email' WHERE $col_ID = $ID";

    $result = $conn->query($sql);
    // Đóng kết nối
    $conn->close();
    if ($result === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}
function getAllAccountByRole($id_role)
{
    global $table_name, $col_ID, $col_name, $col_id_role, $col_phone_number, $col_username, $col_password, $col_birthday, $col_balance, $col_address, $col_email;
    $conn = getConnection();

    $sql = "SELECT * FROM $table_name WHERE $col_id_role = $id_role";
    $result = $conn->query($sql);
    return $result;
}

function getAccountByID($id)
{
    global $table_name, $col_ID, $col_name, $col_id_role, $col_phone_number, $col_username, $col_password, $col_birthday, $col_balance, $col_address, $col_email;
    $conn = getConnection();
    $sql = "SELECT * FROM $table_name WHERE $col_ID = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    }
    return null;
}

function deleteAccount($ID)
{
    global $table_name, $col_ID, $col_name, $col_id_role, $col_phone_number, $col_username, $col_password, $col_birthday, $col_balance, $col_address, $col_email;
    $conn = getConnection();
    $sql = "DELETE FROM $table_name WHERE $col_ID = $ID";
    if ($conn->query($sql) === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function saveAccountRowToSession($data)
{
    global $col_ID, $col_name, $col_id_role, $col_phone_number, $col_username, $col_password, $col_birthday, $col_balance, $col_address, $col_email;
    $_SESSION['ID'] = $data[$col_ID];
    $_SESSION['name'] = $data[$col_name];
    $_SESSION['id_role'] = $data[$col_id_role];
    $_SESSION['phone_number'] = $data[$col_phone_number];
    $_SESSION['username'] = $data[$col_username];
    $_SESSION['password'] = $data[$col_password];
    $_SESSION['birthday'] = $data[$col_birthday];
    $_SESSION['balance'] = $data[$col_balance];
    $_SESSION['address'] = $data[$col_address];
    $_SESSION['email'] = $data[$col_email];
}
?>