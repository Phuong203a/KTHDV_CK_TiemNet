<?php
include('../php/connection.php');
$historyId = $_GET['id'];
$stmt = $dbCon->prepare("SELECT id_user, id_computer, description, time FROM history WHERE id = :history_id");
$stmt->bindParam(':history_id', $historyId);
$stmt->execute();
$history = $stmt->fetch(PDO::FETCH_ASSOC);


    $name = $dbCon->prepare("SELECT name FROM user WHERE ID = ?");
    $name->execute([$history['id_user']]);
    $nameinfo = $name->fetch(PDO::FETCH_ASSOC);

    


$description = $history['description'];
$productDetails = array();
$totalPrice = 0; 
$products = explode(',', $description);
foreach ($products as $product) {
    list($productId, $quantity) = explode('-', $product);
    $stmt = $dbCon->prepare("SELECT name, price FROM service WHERE id = :product_id");
    $stmt->bindParam(':product_id', $productId);
    $stmt->execute();
    $productInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $productName = $productInfo['name'];
    $productPrice = $productInfo['price'];
    $totalPrice += $productPrice * $quantity;
    $productDetails[] = array(
        'name' => $productName,
        'quantity' => $quantity,
        'price' => $productPrice
    );
}
    

    $response = array(
        'id_user' => $history['id_user'],
        'name' => $nameinfo['name'],
        'id_computer' => $history['id_computer'],
        'product_details' => $productDetails, 
        'total_price' => $totalPrice, 
        'time' => $history['time']
    );


header('Content-Type: application/json');
echo json_encode($response);
?>
