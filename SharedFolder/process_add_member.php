<?php
include('../php/connection.php');
session_start();

// Kiểm tra xem dữ liệu từ form đã được gửi đi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $balance = $_POST['balance'];

    // Thực hiện truy vấn để thêm người dùng vào cơ sở dữ liệu
    $sql = "INSERT INTO `user` (`Id_role`, `name`, `email`, `username`, `Password`, `birthday`, `phone`, `address`, `balance`) 
            VALUES (2, :name, :email, :username, :password, :birthday, :phone, :address, :balance)";
    $stmt = $dbCon->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':birthday', $birthday);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':balance', $balance);

    // Thực thi truy vấn
    if ($stmt->execute()) {
        echo '<script>alert("Thêm người dùng thành công.");</script>';
    } else {
        echo '<script>alert("Đã xảy ra lỗi khi thêm người dùng.");</script>';
    }
}
?>
