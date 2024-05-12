<?php
include('../php/connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:wght@900&family=Roboto:wght@900&family=Ultra&family=Yeseva+One&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/style_service.css">
</head>
<style>
    .card{
        margin-top: 20px;
    }
        
    </style>
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
    <a href="ServiceManager.php" class="btn btn-primary" style="margin-left: 10px">Quay lại</a> 
  
  
</nav>
<div class="container">
<?php
  $stmt = $dbCon->prepare("SELECT * FROM history");
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
    // Bắt đầu hiển thị dữ liệu trong bảng
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">ID</th>';
    echo '<th scope="col">ID computer</th>';
    echo '<th scope="col">Total</th>';
    echo '<th scope="col">DateTime</th>';
    echo '<th scope="col">Invoice</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo '<tr>';
      echo '<td>' . $row['id'] . '</td>';
      echo '<td>' . $row['id_computer'] . '</td>';
      echo '<td>' . $row['total'] . ' VND</td>';
      echo '<td>' . $row['time'] . '</td>';
      echo '<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="loadDetails('. $row['id'] .')"> Chi tiết </button></td>';
      echo '</tr>';
  }
  echo '</tbody>';
  echo '</table>';
  } else {
    echo '<p> Không có thông tin lịch sử thanh toán. </p>';
  }
?>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Thông tin chi tiết</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div id="details">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<script>
function loadDetails(historyId) {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '../api/get_details.php?id=' + historyId, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        displayDetails(response);
      } else {
        alert('Có lỗi xảy ra khi tải thông tin.');
      }
    }
  };
  xhr.send();
}
function displayDetails(details) {
  var html = '<ul>';
  html += '<li>ID User: ' + details.id_user + '</li>';
  html += '<li>Name: ' + details.name + '</li>';
  html += '<li>ID Computer: ' + details.id_computer + '</li>';
  html += '<li>Total Price: ' + details.total_price + '</li>';
  html += '<li>Time: ' + details.time + '</li>';
  html += '<li>Product Details:</li>';
  html += '<ul>';
  details.product_details.forEach(function(product) {
    html += '<li>Name: ' + product.name + '</li>';
    html += '<li>Quantity: ' + product.quantity + '</li>';
    html += '<li>Price:  ' + product.price + '</li>';
  });
  html += '</ul>';
  html += '</ul>'; 
  document.getElementById('details').innerHTML = html;
}
</script>
</html>
  