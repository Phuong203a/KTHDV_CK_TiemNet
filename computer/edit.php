<?php
require_once '../extensions/debug.php';
require_once '../services/zone_service.php';
$allZone = getAllZone();
$zoneData = array();
$zoneData[] = array(
    "id" => 0,
    "name" => "Tất cả"
);
if ($allZone->num_rows > 0) {
    // Duyệt qua từng hàng và hiển thị dữ liệu
    while ($row = $allZone->fetch_assoc()) {
        $ID = $row["id"];
        $name = $row["name"];
        $zoneData[] = array(
            "id" => $ID,
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
    <!-- Top navbar -->
    <?php
    include("header.php");
    ?>
    <!-- Top navbar -->

    <div class="container" style="margin-top: 2%; background-color: rgb(255, 255, 255);">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">VIKING</a>
        </nav>
        <br>
        <div>
            <h5>Cập nhật thông tin</h5>
            <form method="post" action="" class="add-data-form">
                <div class="form-group" hidden>
                    <label for="ID">ID:</label>
                    <input type="text" id="ID" name="ID" >
                </div>
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
                    <input type="submit" value="Cập nhật">
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
require_once '../services/computer_service.php';
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
    $ID = $_POST['ID'];
    $name = $_POST['name'];
    $serial = $_POST['serial'];
    $zoneID = $_POST['zoneID'];

    $result = updateComputer($ID, $name, $serial, $zoneID);
    if ($result === TRUE)
    {
        header("Location: edit.php?id=$ID");
    }
    else
    {
        alert("Có lỗi xảy ra");
    }
}
?>