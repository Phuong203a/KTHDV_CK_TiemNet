<?php
require_once 'extensions/debug.php';
require_once 'services/useraccount_service.php';
require_once 'extensions/check_login.php';
// checkLogin(true);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ yêu cầu POST
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check_result = findAccountByUsernameAndPassword($username, $password);
    if ($check_result == null)
    {
        echo "<script>alert('Thông tin đăng nhập không chính xác. Vui lòng thử lại!');</script>";
    }
    else
    {
        $_SESSION['loggedin'] = "true";
        saveAccountRowToSession($check_result);
        redirectMainPageByRole($_SESSION['id_role']);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style_login.css">
</head>
<body>
    <body>
        <div class="container" style="margin-top: 10%;">
            <section id="content">
                <form action="" method = "POST">
                    <h1>Đăng nhập ngay</h1>
                    <div>
                        <input type="text" placeholder="Username" required="" id="username" name="username" />
                    </div>
                    <div>
                        <input type="password" placeholder="Password" required="" id="password" name="password"/>
                    </div>
                    <input type="hidden" name="action" value="login">
                    <div>
                        <input type="submit" value="Log in" />
                        <a href="#">Lost your password?</a>

                    </div>
                </form>
            </section>
        </div>
        </body>
</body>
</html>