<script>
var selectedID = -1;
function setID(id)
{
    selectedID = id;
    console.log("set id: " + selectedID);
}

function deleteComputer()
{
    if (selectedID == -1)
        return;
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

<?php
require_once '../services/zone_service.php';
$allZone = getAllZone();
$zoneData = array();
$zoneData[] = array(
    "ID" => 0,
    "name" => "Tất cả",
    "price_per_hour" => "###"
);
if ($allZone->num_rows > 0) {
    // Duyệt qua từng hàng và hiển thị dữ liệu
    while ($row = $allZone->fetch_assoc()) {
        $ID = $row["ID"];
        $name = $row["name"];
        $price_per_hour = $row["price_per_hour"];
        $zoneData[] = array(
            "ID" => $ID,
            "name" => $name,
            "price_per_hour" => $price_per_hour
        );
    }
}

function showComboBoxZone($zoneData)
{
    echo '<select class="form-select" name="zone" id="zone" onchange="filterZone()">';
    foreach ($zoneData as $data) {
        $zoneId = $data["ID"];
        $name = $data["name"];
        $price_per_hour = $data["price_per_hour"];
        echo '<option cost="'.$price_per_hour.'" value="' . $zoneId . '">' . $name . '</option>';
    }
    echo '</select>';
}

function showComputer($ID, $name, $serial, $zone_id, $zoneData, $state = '')
{
    $zone_name = "";
    foreach ($zoneData as $data)
    {
        if ($data["ID"] == $zone_id)
        {
            $zone_name = $data["name"];
            break;
        }
    }

    $html = '<div class="card card-'.$zone_id.'" style="width: 18rem;">';
    $html .= '<img src="../image/PC.jpg" class="card-img-top"style="height:295px" alt="...">';
    $html .= '<div class="card-body">';
    $html .= '    <h3>Zone: '.$zone_name.'</h3>';
    $html .= '    <h5>ID: '.$ID.'</h5>';
    $html .= '    <p>Name: '.$name.'</p>';
    $html .= '    <p>Serial: '.$serial.'</p>';
    $html .= '    <p hidden class="card-text"style="color: red;">Không hoạt động</p>';
    $html .= '</div>';

    $html .= '<a href="./edit.php?id='.$ID.'" style="color: green !important;"><div class="card-footer text-center btn-light" type="button">';
    $html .= '<h4>Chỉnh sửa thông tin</h4></a>';
    $html .= '</div>';
    $html .= '<button onclick="setID('.$ID.')" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Xóa</button>';


    $html .= '</div>';

    echo $html;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script> -->
    <title>Computer</title>
</head>


<body>
    <!-- Top navbar -->
    <?php
    include("header.php");
    ?>
    <!-- Top navbar -->

    <div style="margin: 1%; background-color: rgb(255, 255, 255);">
        <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">VIKING</a>
        </nav> -->
        <br>
        <div>
            <!-- <h5>Zone: Nomal_01</h5> -->
            <?php
                showComboBoxZone($zoneData);
            ?>
            <h5>Giá: <p id="zone_price">###</p></h5>
        </div>
        <div class="card-deck">
        <?php
        require_once '../services/computer_service.php';
            $allComputers = getAllComputer();
            
            $img_paths = ["../image/PC.jpg"];
            $length = count($img_paths);
            global $table_name, $col_id, $col_name, $col_serial, $col_zone_id;
            if ($allComputers->num_rows > 0) {
                // Duyệt qua từng hàng và hiển thị dữ liệu
                $count = -1;
                while ($row = $allComputers->fetch_assoc()) {
                    $count = ($count+1)%$length;
                    $ID = $row[$col_id];
                    $name = $row[$col_name];
                    $serial = $row[$col_serial];
                    $zone_id = $row[$col_zone_id];
                    showComputer($ID, $name, $serial, $zone_id, $zoneData);
                }
            }
        ?>
        </div>
</body>

</html>


<script>
    function filterZone()
    {
        var selectedOption = $('#zone').find(':selected');
        console.log(selectedOption);
        var cost = selectedOption.attr("cost");
        var zone_price = $("#zone_price");
        zone_price.text(cost + "đ/giờ",);

        var selectedZone = $("#zone").val();
        console.log("filter: " + '.card-' + selectedZone);
        if (selectedZone === "0") {
            $('.card').show();
            } else {
            $('.card').hide();
            $('.card-' + selectedZone).show();
        }
    }
</script>




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
        <button id="btn-yes" onclick="deleteComputer()" type="button" class="btn btn-primary">Đồng ý</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] === 'delete')
    {
        $ID = $_POST['id'];
        $result = deleteComputer($ID);
        if ($result === TRUE)
        {
            //header("Refresh:0");
        }
        else
        {
            alert("Có lỗi xảy ra");
        }
    }
}

?>