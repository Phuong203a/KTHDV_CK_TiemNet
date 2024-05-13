<?php
require_once 'extensions/check_login.php';
checkLogin();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="./lib/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="./lib/css/bootstrap.min.css">
    <script src="./lib/js/bootstrap.min.js"></script>

    <title>Trang quản lý admin</title>
    <style>
        .btn-square-md {
            width: 800px !important;
            max-width: 100% !important;
            max-height: 100% !important;
            height: 300px !important;
            text-align: center;
            padding: 0px;
            font-size:50px;
            text-align: center;
            color: #fff;
            background-size: cover;
            background-position: center;
        }
        #i1{
            /* background-image: url('./image/PC_VIP.webp'); */
            background-color: #80b7ff;
        }
        #i2{
            /* background-image: url('./image/PC.jpg'); */
            background-color: #b0d2ff;
        }
    </style>
</head>
<body>
<!-- Top navbar -->
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="">Trang chủ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="zone/show.php">Quản lý khu vực</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="computer/show.php">Quản lý máy tính</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="staff/show.php">Quản lý nhân viên</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="client/show.php">Quản lý khách hàng</a>
        </li>
        </ul>
        <!-- <form class="form-inline my-2 my-md-0">
        <input class="form-control" type="text" placeholder="Search">
        </form> -->
    </div>
</nav>
<!-- Top navbar -->

    <!-- <div>
        <h2>Chức năng:</h2>
        <ul>
            <li><a class="btn btn-primary btn-square-md" href="zone/show.php">Quản lý Khu vực</a></li>
            <li><a href="computer/show.php">Quản lý Máy tính</a></li>
            <li><a href="quan-ly-nhan-vien.php">Quản lý Nhân viên</a></li>
            <li><a href="quan-ly-dich-vu.php">Quản lý Dịch vụ</a></li>
            <li><a href="quan-ly-tai-khoan.php">Quản lý Tài khoản</a></li>
        </ul>
    </div> -->
    <center>
    <a id="i1" class="card-text btn btn-light btn-square-md" href="zone/show.php">Quản lý Khu vực</a>
    <a id = "i2" class="card-text btn btn-light btn-square-md" href="computer/show.php">Quản lý Máy tính</a>
    <a id="i2" class="card-text btn btn-light btn-square-md" href="staff/show.php">Quản lý Nhân viên</a>
    <a id = "i1" class="card-text btn btn-light btn-square-md" href="client/show.php">Quản lý Khách hàng</a>
    </center>
</body>
</html>


<!-- <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-square-md">Primary</button>
<button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-secondary btn-square-md">Secondary</button>
<button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-square-md">Success</button>
<button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-square-md">Danger</button>
<button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-warning btn-square-md">Warning</button>
<button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-square-md">Info</button>
<button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-light btn-square-md" data-mdb-ripple-color="dark">Light</button>
<button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-square-md"><small>Dark</small></button>
<button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-square-md" data-mdb-ripple-color="dark">Link</button> -->