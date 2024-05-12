<?php
session_start();
// Kiểm tra đăng nhập và truy vấn thông tin người dùng từ cơ sở dữ liệu
require_once('../php/connection.php');

if (!isset($_SESSION['login']) || $_SESSION['login'] !== 'true') {
    header("location: index.php");
    exit;
}

// Kiểm tra xem có tham số username được gửi từ URL không
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    
    // Kiểm tra xem người dùng đã xác nhận xóa chưa
    if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'true') {
        // Thực hiện xóa tài khoản từ cơ sở dữ liệu
        $sqlDelete = "DELETE FROM user WHERE username = ?";
        $stmtDelete = $dbCon->prepare($sqlDelete);
        $stmtDelete->execute([$username]);

        echo "<script>
                alert('Xóa thành công!'); 
                window.history.back();
             </script>";
    } else {
        // Người dùng chưa xác nhận, hiển thị thông báo xác nhận
        echo "<script>
                var result = confirm('Bạn có chắc chắn muốn xóa?');
                if (result) {
                    // Nếu người dùng đồng ý, thực hiện xóa
                    window.location = 'deleteAccount.php?username=$username&confirmed=true';
                } else {
                    // Nếu người dùng không đồng ý, quay lại trang trước đó
                    window.history.back();
                }
              </script>";
    }
} else {
    // Nếu không có tham số username, chuyển hướng người dùng đến trang trước đó
    exit;
}
?>
