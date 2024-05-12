<head>
    <script src="../lib/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../lib/css/bootstrap.min.css">
    <script src="../lib/js/bootstrap.min.js"></script>
</head>
<?php
require_once "../extensions/debug.php";
$current_page = basename($_SERVER['PHP_SELF']);
$li = ["",""];
switch ($current_page)
{
    case "show.php":
        $li[0] = "active";
        break;
    case "add.php":
        $li[1] = "active";
        break;
}
?>
<!-- Top navbar -->
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="../home.php">Trang chủ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item <?=$li[0]?>">
            <a class="nav-link" href="show.php">Xem danh sách máy tính</a>
        </li>
        <li class="nav-item <?=$li[1]?>">
            <a class="nav-link" href="add.php">Thêm máy tính</a>
        </li>
        </ul>
        <!-- <form class="form-inline my-2 my-md-0">
        <input class="form-control" type="text" placeholder="Search">
        </form> -->
    </div>
</nav>
<!-- Top navbar -->