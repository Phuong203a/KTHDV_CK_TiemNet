<?php
include('../php/connection.php');
session_start();


$sqlListAcc = "SELECT * FROM user WHERE Id_role = '3'";
$stmtListAcc = $dbCon->prepare($sqlListAcc);
$stmtListAcc->execute();
$AccInfo  = $stmtListAcc->fetchAll(PDO::FETCH_ASSOC);

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
  <?php if ($roleInfo['Id_role'] == 1): ?>
    <a href="../Admin/AdminHomepage.php" class="btn btn-primary" style="margin-left: 10px">Quay lại</a> 
    <div class="ms-auto">
    <a href="AddStaffAccount.php" class="btn btn-info" style="margin-right: 10px">+ Thêm tài khoản</a> 
    </div>
  <?php elseif ($roleInfo['Id_role'] == 3): ?>
    <a href="../Staff/StaffHomepage.php" class="btn btn-primary" style="margin-left: 10px">Quay lại</a> 
  <?php endif; ?>
  
</nav>
<div class="container">
<table class="table" style="margin-top: 6%;">
        <thead>
            <tr>
                <th scope="col">Name </th>
                <th scope="col">Email</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Birthday</th>
                <th scope="col">Phone</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($AccInfo as $row): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['Password']; ?></td>
                <td><?php echo $row['birthday']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['address']; ?></td>
                
                <?php if ($roleInfo['Id_role'] == 1): ?>
                <td><a class="btn btn-primary"
                href="EditStaff.php?username=<?php echo $row['username']; ?>">Edit Staff</a></td>
                <td><a class="btn btn-danger"
                href="deleteAccount.php?username=<?php echo $row['username']; ?>">Delete</a></td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</div>

</body>
</html>