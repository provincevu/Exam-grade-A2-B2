<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SỬA ĐỒ UỐNG</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        form{
            border: 1px solid rgb(129, 129, 224);
            height: 780px;
            padding-top: 23px;
            margin: 70px 0px 70px 360px;
            background-color: rgb(84, 245, 84);
        }
    </style>
    <script>
        
    </script>
</head>
<body>
    <?php
        session_start();
        require 'connect.php';
        mysqli_set_charset($connect, 'UTF8');
        if(!isset($_SESSION['ten_dang_nhap'])){
            die('<span class="warning">bạn không có quyền truy cập trang này! Nhấp vào <a class="here" href="login.php">đây</a> để quay về trang đăng nhập</span>');
        }
        $ten_dang_nhap = $_SESSION['ten_dang_nhap'];
        $sql = "SELECT * FROM `nhan_vien` WHERE ten_dang_nhap = '$ten_dang_nhap'";
        $info = ($connect->query($sql))->fetch_assoc();
    ?>
    <div class="container">
        <form method="get" class="col-4">
            <h1>SỬA THÔNG TIN CỦA BẠN</h1>
            <div class="form-group">
                Căn cước công dân:
                <input type="text" name="cccd" class="form-control" value="<?php echo $info['cccd'];?>">
            </div>
            <div class="form-group">
                Tên:
                <input type="text" class="form-control" name="ten" value="<?php echo $info['ten'];?>">
            </div>
            <div class="form-group">
                Số điện thoại:
                <input type="text" class="form-control" name="sdt" value="<?php echo $info['sdt'];?>">
            </div>
            <div class="form-group">
                Email:
                <input type="email" class="form-control" name="email" value="<?php echo $info['email'];?>">
            </div>
            <div class="form-group">
                Giới tính:
                <select name="gioi_tinh" id="gioi_tinh">
                    <option value="1" <?php
                        if($info['gioi_tinh_id'] == 1){
                            echo 'selected';
                        }
                    ?>>Nam</option>
                    <option value="2" <?php
                        if($info['gioi_tinh_id'] == 2){
                            echo 'selected';
                        }
                    ?>>Nữ</option>
                </select>
            </div>
            <div class="form-group">
                Ngày sinh:
                <input type="date" class="form-control" name="ngay_sinh" value="<?php echo $info['ngay_sinh'];?>">
            </div>
            <div class="form-group">
                Ảnh đại diện:(nhập đường dẫn tới ảnh của bạn)
                <input type="text" class="form-control" name="anh_dai_dien" value="<?php echo $info['anh_dai_dien'];?>">
            </div>
            <div class="form-group">
                Địa chỉ:
                <input type="text" class="form-control" name="dia_chi" value="<?php echo $info['dia_chi'];?>">
            </div>
            <input type="submit" value="xác nhận" name='edit-profile' id='edit-profile'>
        </form>
    </div>
    <?php
        if(isset($_GET['edit-profile'])){
            $ten_dang_nhap = $_SESSION['ten_dang_nhap'];
            $ten = $_GET['ten'];
            $cccd = $_GET['cccd'];
            $sdt = $_GET['sdt'];
            $email = $_GET['email'];
            $gioi_tinh_id = $_GET['gioi_tinh'];
            $ngay_sinh = $_GET['ngay_sinh'];
            $anh_dai_dien = $_GET['anh_dai_dien'];
            $dia_chi = $_GET['dia_chi'];
            
            $sql = "UPDATE `nhan_vien` SET `cccd`='$cccd',`ten`='$ten',`sdt`='$sdt',`email`='$email',
                    `gioi_tinh_id`='$gioi_tinh_id',`ngay_sinh`='$ngay_sinh',`anh_dai_dien`='$anh_dai_dien',
                    `dia_chi`='$dia_chi' WHERE `ten_dang_nhap`='$ten_dang_nhap'";
            $connect->query($sql);
            header("location: home.php");
        }
        
    ?>
</body>
</html>