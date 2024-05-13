<script>
var selectedID = -1;
function setID(id)
{
    selectedID = id;
    console.log("set id: " + selectedID);
}

function deleteStaff()
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
        console.error('Failed to delete staff:', error);
        // Xử lý lỗi nếu có
      });
}

</script>

<?php
require_once '../services/role_service.php';
$allRole = getAllRole();
$roleData = array();
$roleData[] = array(
    "ID" => 0,
    "Name" => "Tất cả"
);
if ($allRole->num_rows > 0) {
    // Duyệt qua từng hàng và hiển thị dữ liệu
    while ($row = $allRole->fetch_assoc()) {
        $ID = $row["ID"];
        $name = $row["Name"];
        $roleData[] = array(
            "ID" => $ID,
            "Name" => $name
        );
    }
}

function showComboBoxRole($roleData)
{
    echo '<select class="form-select" name="id_role" id="id_role" onchange="">';
    foreach ($roleData as $data) {
        $id = $data["ID"];
        $name = $data["Name"];
        echo '<option value="' . $id . '">' . $name . '</option>';
    }
    echo '</select>';
}

function showAccount($ID, $name, $id_role, $phone_number, $username, $password, $birthday, $balance, $address, $email)
{
    $html = '<tbody>';
    $html .= '<tr>';
    $html .= '  <td>'.$ID.'</td>';
    $html .= '  <td>'.$name.'</td>';
    $html .= '  <td>'.$birthday.'</td>';
    $html .= '  <td>'.$phone_number.'</td>';
    $html .= '  <td>'.$username.'</td>';
    $html .= '  <td>'.$password.'</td>';
    $html .= '  <td><button data-toggle="modal" data-target="#exampleModal" onclick="setID('.$ID.')"><img src="../image/remove.png"alt=""style="width: 30px;"></button></td>';
    $html .= '  <td><a href="./edit.php?id='.$ID.'"><img src="../image/edit.png"alt=""style="width: 30px;"></a></td>';
    $html .= '</tr>';
    $html .= '</tbody>';
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
            <!-- <?php
                showComboBoxRole($roleData);
            ?> -->

<table class="table" style="margin-top: 3%;">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Full name</th>
              <th scope="col">Birthday</th>
              <th scope="col">Phone number</th>
              <th scope="col">Username</th>
              <th scope="col">Password</th>
              <th scope="col">Delete</th>
              <th scope="col">Edit</th>
            </tr>
          </thead>
          <!-- <tbody>
            <tr>
              <td>A123</td>
              <td>Nguyễn Văn A</td>
              <td>20/12/2000</td>
              <td>0987650987</td>
              <td ><img src="../image/remove.png"alt=""style="width: 30px;"></td>
              <td><img src="../image/edit.png" alt=""style="width: 30px;"></td>
            </tr>
          </tbody> -->
          <?php
        require_once '../services/useraccount_service.php';
            $allAccount = getAllAccountByRole(3);

            global $col_ID, $col_name, $col_id_role, $col_phone_number, $col_username, $col_password, $col_birthday, $col_balance, $col_address, $col_email;
            if ($allAccount->num_rows > 0) {
                while ($row = $allAccount->fetch_assoc()) {
                    $ID = $row[$col_id];
                    $name = $row[$col_name];
                    $id_role = $row[$col_id_role];
                    $phone_number = $row[$col_phone_number];
                    $username = $row[$col_username];
                    $password = $row[$col_password];
                    $birthday = $row[$col_birthday];
                    $balance = $row[$col_balance];
                    $address = $row[$col_address];
                    $email = $row[$col_email];
                    showAccount($ID, $name, $id_role, $phone_number, $username, $password, $birthday, $balance, $address, $email);
                }
            }
        ?>
        </table>


        </div>
        <div class="card-deck">
        
        </div>
</body>

</html>


<script>
    function filterZone()
    {
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
        <button id="btn-yes" onclick="deleteStaff()" type="button" class="btn btn-primary">Đồng ý</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->


<?php
require_once '../services/useraccount_service.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] === 'delete')
    {
        $ID = $_POST['id'];
        $result = deleteAccount($ID);
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