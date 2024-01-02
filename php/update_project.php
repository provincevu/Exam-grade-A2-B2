<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SỬA dự án</title>
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
        mysqli_set_charset($connect, 'UTF8');
        $id_du_an = $_GET['id_du_an'];
        $sql = "SELECT * FROM `du_an` WHERE id_du_an = '$id_du_an'";
        $result = $connect->query($sql);
        $row = $result->fetch_assoc();
    ?>
    <div class="container">
        <form method="get" class="col-4">
            <h1>SỬA THÔNG TIN DỰ ÁN</h1>
            <div class="form-group">
                Tên dự án mới:
                <input type="text" name="ten_du_an" class="form-control" placeholder="nhập tên dự án mới" value="<?php echo $row['ten_du_an'];?>">
            </div>
            <div class="form-group">
                Ngày bắt đầu mới:
                <input type="date" class="form-control" name="ngay_bat_dau"  value="<?php echo $row['ngay_bat_dau'];?>">
            </div>
            <div class="form-group">
                Ngày kết thúc mới:
                <input type="date" class="form-control" name="ngay_ket_thuc" value="<?php echo $row['ngay_ket_thuc'];?>">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="id_du_an" value="<?php echo $id_du_an;?>">
            </div>
            <input type="submit" value="xác nhận">
        </form>
    </div>
    <?php
        if(isset($_GET['ten_du_an'])){
            $id_du_an = $_GET['id_du_an'];
            $ten_du_an = $_GET['ten_du_an'];
            $ngay_bat_dau = $_GET['ngay_bat_dau'];
            $ngay_ket_thuc = $_GET['ngay_ket_thuc'];
            
            $sql = "UPDATE `du_an` SET `ten_du_an`='$ten_du_an',`ngay_bat_dau`='$ngay_bat_dau',`ngay_ket_thuc`='$ngay_ket_thuc' WHERE id_du_an = '$id_du_an'";
            $connect->query($sql);
            header("location: home.php");
        }
        
    ?>
</body>
</html>