<?php
include('../php/connection.php');
session_start();


if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $sqlListAcc = "SELECT * FROM user WHERE username = ?";
    $stmtListAcc = $dbCon->prepare($sqlListAcc);
    $stmtListAcc->execute([$username]);
    $AccInfo  = $stmtListAcc->fetchAll(PDO::FETCH_ASSOC);   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Add Profile Staff</title>
</head>
<style>
    body {
        color: #1a202c;
        text-align: left;
        background-color: #ffffff;
    }

    .main-body {
        padding: 15px;
    }

    .card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #f6f6f6;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col,
    .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }

    .mb-3,
    .my-3 {
        margin-bottom: 1rem !important;
    }

    .bg-gray-300 {
        background-color: #000000;
    }

    .h-100 {
        height: 100% !important;
    }

    .shadow-none {
        box-shadow: none !important;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span></button>

    <a href="./ListStaffAccount.php" class="btn btn-primary" style="margin-left: 10px">Quay lại</a> 
</nav>
  
<body>
    <div class="container">
        <div class="main-body">
        <form method="post" action="updateAccount.php">
        <input type="hidden" name="username" value="<?php echo $AccInfo[0]['username']; ?>">

            <div class="row gutters-sm">
                
                <div class="col">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><input type="text" class="form-control" name="name" placeholder="Mời nhập Tên" value="<?php echo $AccInfo[0]['name']?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><input type="text" class="form-control" name="username" placeholder="Mời nhập Username" value="<?php echo $AccInfo[0]['username']?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Password</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><input type="password" class="form-control" name="password" placeholder="Mời nhập Password" value="<?php echo $AccInfo[0]['Password']?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><input type="text" class="form-control" name="email" placeholder="Mời nhập Email" value="<?php echo $AccInfo[0]['email']?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><input type="text" class="form-control" name="phone" placeholder="Mời nhập Số điện thoại" value="<?php echo $AccInfo[0]['phone']?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Birthday</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><input type="date" class="form-control" name="birthday" value="<?php echo $AccInfo[0]['birthday']?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><input type="text" class="form-control" name="address" placeholder="Mời nhập địa chỉ" value="<?php echo $AccInfo[0]['address']?>">
                                </div>
                            </div> 
                            
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-warning"style="margin-left:45%">Lưu chỉnh sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>