<?php
include('../php/connection.php');
session_start();

// Khởi tạo một mảng kết quả
$response = array();

$user_id = $_SESSION['user_id'];
$stmt = $dbCon->prepare("SELECT balance FROM user WHERE ID = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Lưu số dư trong biến
$user_balance = $user['balance'];

$total_price = 0; 

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Lặp qua từng mục trong giỏ hàng
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Truy vấn cơ sở dữ liệu để lấy thông tin sản phẩm từ ID
        $stmt = $dbCon->prepare("SELECT price FROM service WHERE id = :product_id");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $product_total_price = $product['price'] * $quantity;
        $total_price += $product_total_price;
    }
}
if ($user_balance >= $total_price) {
    // Trừ số tiền từ số dư của người dùng
    $new_balance = $user_balance - $total_price;

    // Cập nhật số dư mới vào cơ sở dữ liệu
    $stmt = $dbCon->prepare("UPDATE user SET balance = :new_balance WHERE ID = :user_id");
    $stmt->bindParam(':new_balance', $new_balance);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    
    // Đặt dữ liệu trả về trong mảng response
    $response['success'] = true;
    unset($_SESSION['cart']);
    $response['message'] = "Thanh toán thành công. Số dư mới của bạn là: $new_balance";
} else {
    // Đặt dữ liệu trả về trong mảng response
    $response['success'] = false;
    $response['message'] = "Số dư của bạn không đủ để thanh toán giỏ hàng.";
}

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
