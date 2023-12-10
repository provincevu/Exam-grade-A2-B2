<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SỬA ĐỒ UỐNG</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        form{
            border: 1px solid rgb(129, 129, 224);
            height: 500px;
            padding-top: 23px;
            margin-top: 180px;
            margin-left: 360px;
            background-color: rgb(84, 245, 84);
        }
    </style>
</head>
<body>
    <?php
        require 'connect.php';
        mysqli_set_charset($conn, 'UTF8');
        $do_uong_id = $_GET['do_uong_id'];
        $sql = "SELECT * FROM `do_uong` WHERE do_uong_id = '$do_uong_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
    <div class="container">
        <form method="get" class="col-4">
            <h1>SỬA THÔNG TIN ĐỒ UỐNG</h1>
            <div class="form-group">
                Tên đồ uống mới:
                <input type="text" name="ten_do_uong" class="form-control" placeholder="nhập tên đồ uống mới" value="<?php echo $row['ten_do_uong'];?>">
            </div>
            <div class="form-group">
                Loại đồ uống mới:
                <input type="text" class="form-control" name="loai_do_uong" placeholder="nhập loại đồ uống mới" value="<?php echo $row['loai_do_uong'];?>">
            </div>
            <div class="form-group">
                Giá đồ uống mới:
                <input type="number" class="form-control" name="gia_tien" placeholder="nhập giá đồ uống mới" value="<?php echo $row['gia_tien'];?>">
            </div>
            <div class="form-group">
                Mô tả đồ uống mới:
                <input type="text" class="form-control" name="mo_ta" placeholder="nhập mô tả đồ uống mới" value="<?php echo $row['mo_ta'];?>">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="do_uong_id" value="<?php echo $_GET['do_uong_id'];?>">
            </div>
            <input type="submit" value="xác nhận">
        </form>
    </div>
    <?php
        if(isset($_GET['ten_do_uong'])){
            $ten_do_uong = $_GET['ten_do_uong'];
            $loai_do_uong = $_GET['loai_do_uong'];
            $gia_tien = $_GET['gia_tien'];
            $mo_ta = $_GET['mo_ta'];
            
            $sql = "UPDATE `do_uong` SET `ten_do_uong`='$ten_do_uong',`loai_do_uong`='$loai_do_uong',`gia_tien`='$gia_tien',`mo_ta`='$mo_ta' WHERE do_uong_id = '$do_uong_id'";
            $conn->query($sql);
            header("location: sua_do_uong1.php");
        }
        
    ?>
</body>
</html>