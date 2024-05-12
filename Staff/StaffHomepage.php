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
  <a class="navbar-brand" href=""style="margin-left: 10px">VIKING</a>
  <div class="ms-auto">
    <a href="../php/logout.php" class="btn btn-danger" style="margin-right: 10px">Đăng xuất</a> 
  </div>
</nav>
<div class="container">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Quản lý tài khoản khách hàng</h5>
                <p class="card-text">Xem và thay đổi thông tin tài khoản khách hàng</p>
                <a href="../SharedFolder/ListMemberAccount.php" class="btn btn-primary">Xem thông tin</a>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Quản lý nhân viên</h5>
                <p class="card-text">Xem và thay đổi thông tin tài khoản nhân viên</p>
                <a href="../SharedFolder/ListStaffAccount.php" class="btn btn-primary">Xem thông tin</a>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Quản lý dịch vụ</h5>
                <p class="card-text">Xem và thay đổi các dịch vụ</p>
                <a href="../SharedFolder/ServiceManager.php" class="btn btn-primary">Xem thông tin</a>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Quản lý máy</h5>
                <p class="card-text">Xem thông tin các máy tính và khu vực có trong hệ thống</p>
                <a href="../SharedFolder/ListOfZone.php" class="btn btn-primary">Xem thông tin</a>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Quản lý hóa đơn</h5>
                <p class="card-text">Xem và thông tin các hóa đơn đã thực hiện</p>
                <a href="../SharedFolder/ListOfBills.php" class="btn btn-primary">Xem thông tin</a>
            </div>
        </div>
    </div>

</body>
</html>