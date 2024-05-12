<?php
require_once('connection.php');
session_start();
if (isset($_SESSION['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = 'SELECT ID, username, Password, Id_role FROM user WHERE username = ?';
    try {
        $stmt = $dbCon->prepare($sql);
        $stmt->execute([$username]);
        $loginInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($loginInfo) { // Kiểm tra xem dữ liệu đã được trả về từ cơ sở dữ liệu hay không
            if (($password == $loginInfo['Password']) && ($loginInfo['Id_role'] == '2')) {
                $_SESSION['username'] = $username;
                $_SESSION['login'] = 'true';
                $_SESSION['user_id'] = $loginInfo['ID'];
                header("location: ../Service.php");
            }elseif (($password == $loginInfo['Password']) && ($loginInfo['Id_role'] == '1')) {
                $_SESSION['username'] = $username;
                $_SESSION['login'] = 'true';
                header("location: ../Admin/AdminHomepage.php");
            }elseif (($password == $loginInfo['Password']) && ($loginInfo['Id_role'] == '3')) {
                $_SESSION['username'] = $username;
                $_SESSION['login'] = 'true';
                header("location: ../Staff/StaffHomepage.php");
            }else{
                echo '<script type ="text/javascript">
                    alert("Sai tên đăng nhập hoặc mật khẩu");
                    window.location.href = "http://localhost/";
                    </script>';
            }
        } else { // Nếu không có dữ liệu trả về, hiển thị thông báo
            echo '<script type ="text/javascript">
                    alert("Sai tên đăng nhập hoặc mật khẩu");
                    window.location.href = "http://localhost/";
                    </script>';
        }
    } catch (PDOException $ex) {
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
} 
?>
