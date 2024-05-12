<?php
require_once '../../extensions/debug.php';

include('../../php/connection.php');
session_start();

require_once '../../extensions/debug.php';
require_once '../../services/zone_service.php';

$username = $_SESSION['username'];
$Id_role = "SELECT Id_role FROM user WHERE username = ?";
$stmt = $dbCon->prepare($Id_role);
$stmt->execute([$username]);
$roleInfo = $stmt->fetch(PDO::FETCH_ASSOC);

$allZone = getAllZone();
$zoneData = array();
$zoneData[] = array(
    "ID" => 0,
    "name" => "Tất cả"
);
if ($allZone->num_rows > 0) {
    // Duyệt qua từng hàng và hiển thị dữ liệu
    while ($row = $allZone->fetch_assoc()) {
        $ID = $row["id"];
        $name = $row["name"];
        $zoneData[] = array(
            "ID" => $ID,
            "name" => $name
        );
    }
}

function showComboBoxZone($zoneData)
{
    echo '<select class="form-select" name="zoneID" id="zoneID">';
    foreach ($zoneData as $data) {
        $zoneId = $data["id"];
        $name = $data["name"];
        echo '<option value="' . $zoneId . '">' . $name . '</option>';
    }
    echo '</select>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Computer Information</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
    <style>
        .add-data-form {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span></button>
  <?php if ($roleInfo['Id_role'] == 1): ?>
    <a href="../../Admin/AdminHomepage.php" class="btn btn-primary" style="margin-left: 10px">Quay lại</a> 
  <?php elseif ($roleInfo['Id_role'] == 3): ?>
    <a href="../../Staff/StaffHomepage.php" class="btn btn-primary" style="margin-left: 10px">Quay lại</a> 
  <?php endif; ?>
  <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
        
        <li class="nav-item <?=$li[1]?>">
            <a class="nav-link" href="../ListOfPcs.php">Danh sách Máy tính</a>
        </li>
        </ul>
        <!-- <form class="form-inline my-2 my-md-0">
        <input class="form-control" type="text" placeholder="Search">
        </form> -->
    </div>
  
</nav>

    <div class="container" style="margin-top: 2%; background-color: rgb(255, 255, 255);">
        
        <br>
        <div>
            <h5 style="text-align:center">Nhập thông tin</h5>
            <form method="post" action="" class="add-data-form">
                <div class="form-group">
                    <label for="name">Tên:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="serial">Serial:</label>
                    <input type="text" id="serial" name="serial" required>
                </div>
                <div class="form-group">
                <label for="zoneID">Khu vực:</label>
                <?php
                    showComboBoxZone($allZone);
                ?>
                </div>
                <div class="form-group">
                    <input type="submit" value="Thêm">
                </div>
            </form>
        </div>
        
</body>
<!-- <script src="../lib/jquery-3.7.1.min.js"></script> -->
<script>
    function fillValue(name, serial, zoneID, id)
    {
        $('#ID').val(id);
        $('#name').val(name);
        $('#serial').val(serial);
        $('#zoneID').val(zoneID);
    }
</script>


</html>
<?php
require_once '../../services/computer_service.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']))
{
    global $table_name, $col_id, $col_name, $col_serial, $col_zone_id;
    $ID = $_GET['id'];
    $row = getComputerByID($ID);
    if ($row != null)
    {
        $ID = $row[$col_id];
        $name = $row[$col_name];
        $serial = $row[$col_serial];
        $zoneID = $row[$col_zone_id];
    
        echo "<script>fillValue('$name', '$serial', $zoneID, $ID)</script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $serial = $_POST['serial'];
    $zoneID = $_POST['zoneID'];

    $result = insertComputer($name, $serial, $zoneID);
    if ($result === TRUE)
    {
        alert("Thêm máy tính mới thành công");
        exit();
    }
    else
    {
        alert("Có lỗi xảy ra");
    }
}
?>