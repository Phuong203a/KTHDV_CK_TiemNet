<?php
include('php/connection.php');
session_start();
if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = 'false';
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
                <form action="php/login.php" method="post">
                    <h1>Đăng nhập ngay</h1>
                    <div>
                        <input type="text" placeholder="Username" required="" id="username" name="username" />
                    </div>
                    <div>
                        <input type="password" placeholder="Password" required="" id="password" name="password" />
                    </div>
                    <div>
                        <input type="submit" value="Log in" />
                    </div>
                </form>
            </section>
        </div>
        </body>
</body>
</html>