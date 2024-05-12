<?php
include('../php/connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];

    // Cập nhật thông tin người dùng trong cơ sở dữ liệu
    $sqlUpdate = "UPDATE user SET name=?, Password=?, email=?, phone=?, birthday=?, address=? WHERE username=?";
    $stmtUpdate = $dbCon->prepare($sqlUpdate);
    $stmtUpdate->execute([$name, $password, $email, $phone, $birthday, $address, $username]);

    // Chuyển hướng người dùng về trang danh sách tài khoản nhân viên sau khi cập nhật
    echo "<script>alert('Cập nhật thành công.');
     window.location.href = 'ListStaffAccount.php';</script>";    
    exit;
}
?>
