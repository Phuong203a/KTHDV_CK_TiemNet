<?php
session_start();

// Xóa tất cả các biến session
session_unset();

// Xóa toàn bộ session
session_destroy();

header('Location: login.php');
?>