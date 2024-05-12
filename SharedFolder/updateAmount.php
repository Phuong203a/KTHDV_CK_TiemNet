<?php
include('../php/connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['balance']) && isset($_POST['action'])) {
        $username = $_POST['username'];
        $balanceToAdd = $_POST['balance'];
        $action = $_POST['action'];

        // Lấy balance hiện tại từ database
        $sqlGetBalance = "SELECT balance FROM user WHERE username = ?";
        $stmtGetBalance = $dbCon->prepare($sqlGetBalance);
        $stmtGetBalance->execute([$username]);
        $currentBalance = $stmtGetBalance->fetchColumn();

        // Lấy ID người dùng
        $getIdUser = $dbCon->prepare("SELECT ID FROM user WHERE username = ?");
        $getIdUser->execute([$username]);
        $currentID = $getIdUser->fetchColumn();

        // Cộng thêm số tiền đã chọn vào balance hiện tại
        $newBalance = $currentBalance + $balanceToAdd;

        // Cập nhật balance mới vào database
        $sqlUpdateBalance = "UPDATE user SET balance = ? WHERE username = ?";
        $stmtUpdateBalance = $dbCon->prepare($sqlUpdateBalance);
        $stmtUpdateBalance->execute([$newBalance, $username]);

        // Lấy thời gian hiện tại
        $time = date('Y-m-d H:i:s');

        // Thêm dữ liệu vào bảng paymenthistory
        $sqlInsertHistory = "INSERT INTO `paymenthistory` (`id_user`, `amount`, `action`, `status`, `time`) 
            VALUES (:id_user, :amount, :action, 'Success', :time)";
        $stmtInsertHistory = $dbCon->prepare($sqlInsertHistory);
        $stmtInsertHistory->bindParam(':id_user', $currentID);
        $stmtInsertHistory->bindParam(':amount', $balanceToAdd);
        $stmtInsertHistory->bindParam(':action', $action);
        $stmtInsertHistory->bindParam(':time', $time);
        $stmtInsertHistory->execute();

        // Chuyển hướng người dùng về trang khác hoặc hiển thị thông báo thành công
        echo '<script>alert("Nạp tiền thành công!"); window.location.href = "ListMemberAccount.php";</script>';
    } else {
        // Xử lý lỗi nếu không có đủ dữ liệu đầu vào
        echo "Missing username, balance, or action data.";
    }
} else {
    // Xử lý nếu không phải là phương thức POST
    echo "Invalid request method.";
}
?>
