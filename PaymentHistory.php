<!DOCTYPE html>
<html lang="en">

<head>
  <title> Payment History</title>
</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
      aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Payment History</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link " href="Service.php" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false"> Service </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link " href="ProfileClient.php" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false"> Profile </a>
        </li>
      </ul>
    </div>
    <a href="php/logout.php" class="btn btn-danger float-right">Đăng xuất</a> 
  </nav>
  <?php
include('php/connection.php');

// Truy vấn cơ sở dữ liệu để lấy thông tin từ bảng paymenthistory
$stmt = $dbCon->prepare("SELECT * FROM paymenthistory");
$stmt->execute();
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body style="font-family: 'Times New Roman', Times, serif; font-size: 20px; ">
    <table class="table" style=" margin-left: 6%;margin-top: 3%;">
        <thead>
            <tr>
                <th scope="col">Transaction ID</th>
                <th scope="col">ID User</th>
                <th scope="col">Amount</th>
                <th scope="col">Action</th>
                <th scope="col">Status</th>
                <th scope="col">DateTime</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payments as $payment) : ?>
                <tr>
                    <td><?php echo $payment['id']; ?></td>
                    <td><?php echo $payment['id_user']; ?></td>
                    <td><?php echo $payment['amount']; ?></td>
                    <td><?php echo $payment['action']; ?></td>
                    <td><?php echo $payment['status']; ?></td>
                    <td><?php echo $payment['time']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
      
</body>
  </html>
  