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
    <a href="./ListMemberAccount.php" class="btn btn-primary" style="margin-left: 10px">Quay lại</a> 
  
</nav>
<div class="container">
        <div class="main-body">
        <form method="post" action="updateAmount.php">
        <input type="hidden" name="username" value="<?php echo $AccInfo[0]['username']; ?>">

            <div class="row gutters-sm">
                
                <div class="col">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col" style="center">
                                    <h3 class="mb-0">Số tiền bạn muốn nạp</h6>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Số tiền</h6>
                                </div>
                                <select name="balance" class="col-sm-9 text-secondary">
                                <option value="20000">Nạp 20k</option>
                                <option value="50000">Nạp 50k</option>
                                <option value="100000">Nạp 100k</option>
                                <option value="200000">Nạp 200k</option>
                                <option value="500000">Nạp 500k</option>
                                </select>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Hình thức</h6>
                                </div>
                                <select name="action" class="col-sm-9 text-secondary">
                                <option value="Tiền Mặt">Tiền mặt</option>
                                <option value="Trừ từ ví">Tài khoản</option>
                                
                                </select>
                            </div>
                            
                            
                        
                    </div>
                    </div>
                    <button type="submit" class="btn btn-warning"style="margin-left:50%">Nạp</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>