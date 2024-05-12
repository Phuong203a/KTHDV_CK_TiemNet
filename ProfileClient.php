<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Profile</title>
</head>
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                  aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">Profile</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                      <a class="nav-link " href="Service.php" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false"> Service </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link " href="PaymentHistory.php" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false"> Payment History </a>
                    </li>
                  </ul>
                </div>
                <a href="php/logout.php" class="btn btn-danger float-right">Đăng xuất</a>   
              </nav>
<body>
    <div class="container">
        <div class="main-body">
            
            <?php
                include('php/connection.php');
                session_start();
                    // Lấy thông tin của khách hàng từ cơ sở dữ liệu
                    $user_id = $_SESSION['user_id'];
                    $stmt = $dbCon->prepare("SELECT * FROM user WHERE ID = :user_id");
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->execute();
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4><?php echo $user['name']; ?></h4>                                        <p style="color: green!important;" class="text-secondary mb-1">Số dư: <?php echo number_format($user['balance']); ?>đ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row"> 
                                <div class="col-sm-3"> <h6 class="mb-0">Username</h6> </div>
                                <div class="col-sm-9 text-secondary"> <?php echo $user['username']; ?> </div>
                            </div>
                            <hr> 
                            <div class="row">
                                <div class="col-sm-3"> <h6 class="mb-0">Email</h6></div>
                                <div class="col-sm-9 text-secondary"> <?php echo $user['email']; ?> </div>
                            </div>
                            <hr>    
                            <div class="row">
                                <div class="col-sm-3"> <h6 class="mb-0">Birthday</h6></div>
                                <div class="col-sm-9 text-secondary"> <?php echo $user['birthday']; ?> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3"> <h6 class="mb-0">Phone Number</h6></div>
                                <div class="col-sm-9 text-secondary"> <?php echo $user['phone']; ?> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3"> <h6 class="mb-0">Address</h6></div>
                                <div class="col-sm-9 text-secondary"> <?php echo $user['address']; ?> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</body>

</html>