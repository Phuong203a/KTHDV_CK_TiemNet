<?php
session_start();

function add_product_to_cart($product_id) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (array_key_exists($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
}

function is_get_request() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

if (is_get_request() && isset($_GET['id'])) {
    $product_id = $_GET['id'];
    add_product_to_cart($product_id);
    
    http_response_code(200);
    echo json_encode(array("message" => "Product added to cart successfully."));
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Bad request."));
}
?>
