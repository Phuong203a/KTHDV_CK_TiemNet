<?php
$host = 'localhost';
$dbName = 'net';
$username = 'root';
$password = '';

try {
    $dbCon = new PDO("mysql:host=" . $host . ";dbname=" . $dbName, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'data' => 'Unable to connect: ' . $ex->getMessage())));
}
?>