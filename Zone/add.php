<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
    <title>Zone</title>


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

        input[type="text"] {
            width: 100%;
            padding: 5px;
        }
    </style>
</head>

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
            <h5>Thêm khu vực mới</h5>
            <form method="post" action="" class="add-data-form">
                <div class="form-group">
                    <label for="name">Tên:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="price_per_hour">Giá/Giờ:</label>
                    <input type="text" id="price_per_hour" name="price_per_hour" required>
                </div>

                <div class="form-group">
                    <label for="keyboard">Bàn phím:</label>
                    <input type="text" id="keyboard" name="keyboard" required>
                </div>

                <div class="form-group">
                    <label for="mouse">Chuột:</label>
                    <input type="text" id="mouse" name="mouse" required>
                </div>

                <div class="form-group">
                    <label for="headphone">Tai nghe:</label>
                    <input type="text" id="headphone" name="headphone" required>
                </div>

                <div class="form-group">
                    <label for="cpu">CPU:</label>
                    <input type="text" id="cpu" name="cpu" required>
                </div>

                <div class="form-group">
                    <label for="ram">RAM:</label>
                    <input type="text" id="ram" name="ram" required>
                </div>

                <div class="form-group">
                    <label for="card">Card màn hình:</label>
                    <input type="text" id="card" name="card" required>
                </div>

                <div class="form-group">
                    <label for="chair">Ghế:</label>
                    <input type="text" id="chair" name="chair" required>
                </div>

                <div class="form-group">
                    <input type="submit" value="Thêm">
                </div>
            </form>
        </div>
        
</body>

</html>


<?php
require_once '../extensions/debug.php';
require_once '../services/zone_service.php';
// Kiểm tra xem có yêu cầu POST hay không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $priceHour = $_POST['price_per_hour'];
    $keyboard = $_POST['keyboard'];
    $mouse = $_POST['mouse'];
    $headphone = $_POST['headphone'];
    $cpu = $_POST['cpu'];
    $ram = $_POST['ram'];
    $card = $_POST['card'];
    $chair = $_POST['chair'];

    $result = insertZone($name, $priceHour, $keyboard, $mouse, $headphone, $cpu, $ram, $card, $chair);
    if ($result === TRUE)
    {
        alert("Thêm khu vực thành công");
    }
    else
    {
        alert("Có lỗi xảy ra");
    }
}
?>


<!-- <script src="../lib/jquery-3.7.1.min.js"></script> -->
<script>
    function fillValue(name, price,keyboard,mouse,headphone,cpu,ram,card,chair)
    {
        $('#name').val(name);
        $('#price_per_hour').val(price);
        $('#keyboard').val(keyboard);
        $('#mouse').val(mouse);
        $('#headphone').val(headphone);
        $('#cpu').val(cpu);
        $('#ram').val(ram);
        $('#card').val(card);
        $('#chair').val(chair);
    }

    function fillSampleValue(id = "TEST")
    {
        fillValue("Name " + id, 50000,"Keyboard TEST", "Mouse TEST", "Headphone TEST", "CPU TEST", "RAM TEST", "Card TEST", "Chair TEST");
    }
</script>