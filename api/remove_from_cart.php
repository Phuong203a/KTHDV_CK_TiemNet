<?php
session_start();

function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function remove_product_from_cart($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

if (is_post_request()) {
    $product_id = isset($_POST['remove_product_id']) ? $_POST['remove_product_id'] : '';

    if (!empty($product_id)) {
        remove_product_from_cart($product_id);
        http_response_code(200);
        echo json_encode(array("message" => "Product removed from cart successfully."));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Product ID is missing."));
    }
} else {
    http_response_code(405);
    echo json_encode(array("message" => "Method not allowed."));
}
?>
