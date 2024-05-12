<?php
require_once '../extensions/debug.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Computer Information</title>

    <style>
        .add-data-form {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
        }

        .input-field {
            width: 100%;
            padding: 5px;
        }
    </style>
</head>

<?php
require_once '../services/useraccount_service.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST["ID"];
    $name = $_POST["name"];
    $id_role = $_POST["id_role"];
    $phone_number = $_POST["phone_number"];
    $birthday = $_POST["birthday"];
    $address = $_POST["address"];
    $email = $_POST["email"];

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = updateAccount($ID, $name, $id_role, $phone_number, $username, $password, $birthday, 0, $address, $email);
    if ($result === TRUE)
    {
        alert("Cập nhật thành công");
        header("Location: edit.php?id=$ID");
    }
    else
    {
        alert("Có lỗi xảy ra");
    }
}
?>
<body>
    <!-- Top navbar -->
    <?php
    include("header.php");
    ?>
    <!-- Top navbar -->

    <div class="container" style="margin-top: 2%; background-color: rgb(255, 255, 255);">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">VIKING</a>
        </nav>
        <br>
        <div>
            <h5>Nhập thông tin</h5>
            <form class="add-data-form" method="POST" action="">
                <div class="form-group" hidden>
                    <label for="ID">Name:</label>
                    <input class="input-field" type="text" id="ID" name="ID" required>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input class="input-field" type="text" id="name" name="name" required>
                </div>

                <div class="form-group" hidden>
                <label for="id_role">Role ID:</label>
                <input  class="input-field" type="text" id="id_role" name="id_role" value=3>
                </div>

                <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input  class="input-field" type="text" id="phone_number" name="phone_number" required>
                </div>

                <div class="form-group">
                <label for="username">Username:</label>
                <input class="input-field" type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                <label for="password">Password:</label>
                <input class="input-field"  type="text" id="password" name="password" required>
                </div>

                <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input  class="input-field" type="date" id="birthday" name="birthday" required>
                </div>

                <!-- <div class="form-group">
                <label for="balance">Balance:</label>
                <input class="input-field"  type="number" id="balance" name="balance" required>
                </div> -->

                <div class="form-group">
                <label for="address">Address:</label>
                <input class="input-field"  id="address" name="address" required>
                </div>

                <div class="form-group">
                <label for="email">Email:</label>
                <input class="input-field"  type="email" id="email" name="email" required>
                </div>
                
                <input type="submit" value="Cập nhật">
            </form>
        </div>
        
</body>
<!-- <script src="../lib/jquery-3.7.1.min.js"></script> -->
<script>
    function fillValue(name, phone_number, birthday, address, email, username, password, id)
    {
        $('#ID').val(id);
        $('#name').val(name);
        $('#phone_number').val(phone_number);
        $('#birthday').val(birthday);
        $('#address').val(address);
        $('#email').val(email);
        $('#username').val(username);
        $('#password').val(password);
    }
</script>


</html>
<?php


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']))
{
    global $col_ID, $col_name, $col_id_role, $col_phone_number, $col_username, $col_password, $col_birthday, $col_balance, $col_address, $col_email;
    $ID = $_GET['id'];
    $row = getAccountByID($ID);
    if ($row != null)
    {
        $ID = $row[$col_ID];
        $name = $row[$col_name];
        $id_role = $row[$col_id_role];
        $phone_number = $row[$col_phone_number];
        $birthday = $row[$col_birthday];
        $address = $row[$col_address];
        $email = $row[$col_email];

        $username = $row[$col_username];
        $password = $row[$col_password];
    
        echo "<script>fillValue('$name', '$phone_number', '$birthday','$address','$email','$username','$password', $ID)</script>";
    }
}




function generateRandomString($l)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $l; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}
?>






