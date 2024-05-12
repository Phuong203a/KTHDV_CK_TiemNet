<?php
include('../php/connection.php');
session_start();
// Kiểm tra xem dữ liệu từ form đã được gửi đi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $id = $_POST['id_category'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $img = $_POST['img'];


    // Thực hiện truy vấn để thêm người dùng vào cơ sở dữ liệu
    $sql = "INSERT INTO `service` (`id_category`, `name`, `price`, `img`) 
            VALUES (:id_category, :name, :price, :img)";
    $stmt = $dbCon->prepare($sql);
    $stmt->bindParam(':id_category', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':img', $img);
    

    // Thực thi truy vấn
    if ($stmt->execute()) {
        echo '<script>alert("Thêm dịch vụ thành công.");';
        echo 'window.location.href = "ServiceManager.php";</script>';
    } else {
        echo '<script>alert("Đã xảy ra lỗi khi thêm người dùng.");</script>';
    }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
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

                <form method="POST" id="form"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Loại dịch vụ</h6>
                                </div>
                                <select name="id_category" class="col-sm-9 text-secondary">
                                <option value="1">Drink</option>
                                <option value="2">Food</option>
                                <option value="3">Time</option>
                                </select>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><input type="text" name="name" class="form-control" placeholder="Mời nhập Tên dịch vụ">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Giá tiền</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><input type="text" name="price" class="form-control" placeholder="Mời nhập Giá tiền">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Hình ảnh</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><input type="text" name="img" class="form-control" placeholder="Nhập URL của img">
                                </div>
                            </div>
                            
        <button type="submit" class="btn btn-info" style="margin-left:50%">+Thêm</button>
    </form>
</div>

</body>
</html>