<?php
include('php/connection.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:wght@900&family=Roboto:wght@900&family=Ultra&family=Yeseva+One&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="./css/style_service.css">
</head>
<body>
<?php
    function checkLogin()
    {
        if ($_SESSION['login']=true) {
            echo '<script type ="text/javascript">
                alert("Vui lòng đăng nhập để sử dụng chức năng này");
                window.location.href = "http://localhost/";
                </script>';
        } 
    }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span></button>
  <a class="navbar-brand" href="">VIKING</a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" href="History.php" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">History</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="ProfileClient.php" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile</a>
      </li>
    </ul>
  </div>
  <a href="php/logout.php" class="btn btn-danger float-right">Đăng xuất</a> 
</nav>

<div class="container-fluid">
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cartModal"> View Cart </button>
<?php 
  for ($category_id = 1; $category_id <= 3; $category_id++) {

    $sql = "SELECT * FROM service WHERE id_category = :category_id";
    $stmt = $dbCon->prepare($sql);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Kiểm tra xem có sản phẩm nào không
    if ($products) {
        // Hiển thị danh sách sản phẩm dưới dạng card
        if ($category_id == 1) { echo "<h2> Drink </h2>"; }
          else if ($category_id == 2) { echo "<h2> Food </h2>"; }
            else { echo "<h2> Times </h2>"; }
        foreach ($products as $product) {
            echo '<div class="card">';
            echo '  <div class="card-header ">';  
            echo '    <img src="' . $product['img'] . '" alt="' . $product['name'] . '">';
            echo '  </div>';
            echo '  <div class="card-body ">';
            echo '    <h5 class="card-title">' . $product['name'] . '</h5>';
            echo '    <p class="card-text">Price: ' . $product['price'] . 'VND </p>';
            echo '  </div>';
            echo '  <div class="footer">';
            echo '  <a class="btn btn-success" onclick="addToCart('.$product['id'].')">Add to Cart</a>'; 
            echo '  </div>';
            echo '</div>';
        }
    } else {
      if ($category_id == 1) { echo "<h2> Drink </h2>"; }
        else if ($category_id == 2) { echo "<h2> Food </h2>"; }
          else { echo "<h2> Times </h2>"; }
      echo "No products found";
    }}
?>        

<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Here goes the content of the shopping cart -->
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php

            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                foreach($_SESSION['cart'] as $product_id => $quantity) {
                    // Truy vấn để lấy thông tin sản phẩm từ cơ sở dữ liệu
                    $stmt = $dbCon->prepare("SELECT * FROM service WHERE id = :product_id");
                    $stmt->bindParam(':product_id', $product_id);
                    $stmt->execute();
                    $product = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // Hiển thị thông tin sản phẩm trong modal
                    echo '<tr>';
                    echo '<td>' . $product['name'] . '</td>';
                    echo '<td>' . $product['price'] . '</td>';
                    echo '<td>' . $quantity . '</td>';
                    echo '<td>' . ($product['price'] * $quantity) . '</td>';
                    echo '<td>  <button type="button" class="btn btn-danger" onclick="removeFromCart(' . $product['id'] .')">Remove</button></td>';
                    echo '</tr>';
                } 
            } else {
                echo '<tr><td colspan="4">No items in cart</td></tr>';
            }
            
            ?>
          </tbody>
        </table>
        <?php 
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
            }   }
          echo "Tổng số tiền của giỏ hàng là: " . number_format($total_price) . " VND";    
        ?>
      </div>
      <div class="modal-footer">
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" rows="3"></textarea>
        </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <?php 
          if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            echo '<button class="btn btn-success" onclick="processPayment() ">Thanh toán</button>';
            echo '<button class="btn btn-success" onclick="CashPayment() ">Thanh toán tiền mặt </button>'; }
        ?>
      </div>
    </div>
  </div>
</div>
<script>
    function CashPayment() {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "api/remove_cart.php", true);
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                var response = JSON.parse(xhr.responseText);
                alert("Nhân viên sẽ đến thu tiền trong vài phút.");
                location.reload();
            } else {
                // Xảy ra lỗi khi gửi yêu cầu
                alert("Failed to clear cart. Please try again later.");
            }
        }
    };

    // Gửi yêu cầu POST đến API
    xhr.send();
    }
    function processPayment() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'api/payment.php', true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert(response.message);
                    window.location.reload();
                } else {
                    alert(response.message);
                    window.location.reload();
                }
            } else {
                alert('There was a problem with the request.');
                window.location.reload();
            }
        }
    };
    xhr.send();
}

    function addToCart(productId) {
    fetch('api/add_to_cart.php?id=' + productId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message); // Output success message
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error.message); // Output error message
        });
    }
    function removeFromCart(productId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "api/remove_from_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) { 
                console.log("Product removed from cart successfully.");
                location.reload();
            } else {
                console.error("Error: " + xhr.statusText);
            }
        }
    };
    var data = "remove_product_id=" + encodeURIComponent(productId);
    xhr.send(data);
}
</script>
</body>
</html>