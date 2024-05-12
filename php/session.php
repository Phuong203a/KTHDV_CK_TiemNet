<?php
   $conn = new mysqli('localhost','root','','final');
   session_start();
   if (mysqli_connect_error())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>