<?php
include('php/connection.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>History</title>
</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<script>
</script>
<style>
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
  <a class="navbar-brand" href="#">History</a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
      <a class="nav-link " href="Service.php" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">Service</a> </li>
    </ul>
    <a href="php/logout.php" class="btn btn-danger float-right">Đăng xuất</a> 
  </div>
</nav>
<body style="font-family: 'Times New Roman', Times, serif; font-size: 20px; ">
<div class="container">
<?php
  $stmt = $dbCon->prepare("SELECT * FROM history WHERE id_user = :user_id");
  $stmt->bindParam(':user_id', $user_id);
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
  xhr.open('POST', 'api/get_details.php?id=' + historyId, true);
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
  