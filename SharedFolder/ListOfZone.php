<?php
include('../php/connection.php');
session_start();

require_once '../extensions/debug.php';
require_once '../services/zone_service.php';

$username = $_SESSION['username'];
$Id_role = "SELECT Id_role FROM user WHERE username = ?";
$stmt = $dbCon->prepare($Id_role);
$stmt->execute([$username]);
$roleInfo = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
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
    <title>Zone</title>
</head>
<script src="../lib/jquery-3.7.1.min.js"></script>
<script>
    var selectedID = "0";
    function setID(id)
    {
        selectedID = id;
    }

    function deleteZone()
    {
        $.post('', {action:'delete', id: selectedID })
        .done(function(response) {
        //console.log('Zone deleted successfully:', response);
        alert("Xóa dữ liệu thành công");
        location.reload();
      })
      .fail(function(error) {
        console.error('Failed to delete zone:', error);
        // Xử lý lỗi nếu có
      });
    }
</script>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span></button>
  <?php if ($roleInfo['Id_role'] == 1): ?>
    <a href="../Admin/AdminHomepage.php" class="btn btn-primary" style="margin-left: 10px">Quay lại</a> 
  <?php elseif ($roleInfo['Id_role'] == 3): ?>
    <a href="../Staff/StaffHomepage.php" class="btn btn-primary" style="margin-left: 10px">Quay lại</a> 
  <?php endif; ?>
  <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
        
        <li class="nav-item <?=$li[1]?>">
            <a class="nav-link" href="./Zone/add.php">Thêm Khu vực</a>
        </li>
        <li class="nav-item <?=$li[1]?>">
            <a class="nav-link" href="./ListOfPcs.php">Quản lý máy tính</a>
        </li>
        </ul>
        <!-- <form class="form-inline my-2 my-md-0">
        <input class="form-control" type="text" placeholder="Search">
        </form> -->
    </div>
  
</nav>
<?php

$allZone = getAllZone();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] === 'delete')
    {
        $ID = $_POST['id'];
        $result = deleteZone($ID);
        if ($result === TRUE)
        {
            // alert("Dữ liệu đã được xóa");
            // header("Refresh:0");
        }
        else
        {
            alert("Có lỗi xảy ra");
        }
    }
}
?>
<body>
    
    <!-- Top navbar -->

    <div class="container" style="margin-top: 2%; background-color: rgb(255, 255, 255);">
        
        <br>
        <div>
            <h5>Khu vực</h5>
        </div>
        <div class="card-deck">

<?php
$img_paths = ['../image/PC.jpg','../image/PC_VIP.webp'];
$length = count($img_paths);
global $table_name, $col_id, $col_name, $col_price_per_hour, $col_keyboard, $col_mouse, $col_headphone, $col_cpu, $col_ram, $col_card, $col_chair;
if ($allZone->num_rows > 0) {
    // Duyệt qua từng hàng và hiển thị dữ liệu
    $count = -1;
    while ($row = $allZone->fetch_assoc()) {
        $count = ($count+1)%$length;
        $ID = $row[$col_id];
        $name = $row[$col_name];
        $price_per_hour = $row[$col_price_per_hour];
        $keyboard = $row[$col_keyboard];
        $mouse = $row[$col_mouse];
        $monitor = $row[$col_monitor];
        $cpu = $row[$col_cpu];
        $ram = $row[$col_ram];
        $card = $row[$col_card];
        $chair = $row[$col_chair];
        show($ID, $name, $price_per_hour, $keyboard, $mouse,$monitor,$cpu,$ram,$card,$chair,$img_paths[$count]);
    }
}

function show($ID, $name, $price_per_hour, $keyboard, $mouse,$monitor,$cpu,$ram,$card,$chair,$img_path)
{
    $html = '<div class="card" style="width: 18rem;">';
    $html .= '<img src="'.$img_path.'" class="card-img-top" style="height:295px" alt="...">';
    $html .= '<div class="card-body">';
    $html .= '<h4>ID:'.$ID.'</h4>';
    $html .= '<h5 class="card-title">'.$name.' </h5>';
    $html .= '<p class="card-text">Chất lượng dịch vụ cao cấp: Thông thường, game thủ tìm đến các phòng cyber game cao cấp sẽ có nhiều nhu cầu về gaming hơn khi tìm đến những phòng net cỏ thông thường. Do đó, để đảm bảo sự trải nghiệm tuyệt vời nhất cho khách hàng nên các quán net cao cấp, vip thường trang bị nhiều phân khúc cấu hình với mức giá giờ chơi khác nhau. Từ cấu hình máy thường, cao cấp cho đến Vip.</p>';
    $html .= '</div>';
    $html .= '<ul class="list-group list-group-flush">';
    $html .= '<li class="list-group-item">CPU: '.$cpu.'</li>';
    $html .= '<li class="list-group-item">RAM: '.$ram.'</li>';
    $html .= '<li class="list-group-item">VGA: '.$card.'</li>';
    $html .= '<li class="list-group-item">Keyboard: '.$keyboard.'</li>';
    $html .= '<li class="list-group-item">Monitor: '.$monitor.'</li>';
    $html .= '<li class="list-group-item">Mouse: '.$mouse.'</li>';
    $html .= '<li class="list-group-item">Chair: '.$chair.'</li>';
    $html .= '<li class="list-group-item" style="color:rgb(255, 1, 1);">Giá: '.$price_per_hour.'đ/hour</li>';
    $html .= '</ul>';
    $html .= '<a href="./Zone/edit.php?id='.$ID.'" style="color: green !important;"><div class="card-footer text-center btn-light" type="button">';
    $html .= '<h4>Chỉnh sửa thông tin</h4></a>';
    $html .= '</div>';
    $html .= '<button onclick="setID('.$ID.')" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Xóa</button>';
    $html .= '</div>';
    echo $html;
}

?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Bạn có chắc muốn xóa dữ liệu này chứ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button id="btn-yes" onclick="deleteZone()" type="button" class="btn btn-primary">Đồng ý</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
</body>

</html>
