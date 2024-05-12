<?php
session_start();

// Hàm kiểm tra xem có phải là yêu cầu POST hay không
function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

// Hàm xoá toàn bộ giỏ hàng
function clear_cart() {
    if(isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
        return true;
    }
    return false;
}

// Kiểm tra nếu là yêu cầu POST
if(is_post_request()) {
    // Gọi hàm để xoá toàn bộ giỏ hàng
    if(clear_cart()) {
        // Trả về thông báo thành công nếu xoá thành công
        http_response_code(200);
        echo json_encode(array("message" => "Cart cleared successfully."));
    } else {
        // Trả về thông báo lỗi nếu không có giỏ hàng
        http_response_code(404);
        echo json_encode(array("message" => "Cart not found."));
    }
} else {
    // Trả về thông báo lỗi nếu không phải là yêu cầu POST
    http_response_code(405);
    echo json_encode(array("message" => "Method not allowed."));
}
?>
