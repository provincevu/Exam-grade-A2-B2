<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD CUSTOMER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        form{
            border: 1px solid rgb(129, 129, 224);
            height: 300px;
            padding-top: 23px;
            margin-top: 180px;
            margin-left: 360px;
            background-color: rgb(84, 245, 84);
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="get" class="col-4">
            <h1>ĐĂNG NHẬP</h1>
            <div class="form-group">
                Tên đăng nhập:
                <input type="text" name="ten_dang_nhap" class="form-control" placeholder="điền tên đăng nhập của bạn">
            </div>
            <div class="form-group">
                Mật khẩu:
                <input type="password" class="form-control" name="mat_khau" placeholder="nhập mật khẩu của bạn">
            </div>
            <input type="submit" value="Đăng Nhập" name='login'>
            <a href="sign_up.php">Đăng Ký</a>
        </form>
    </div>
    <?php
        if(isset($_GET['login'])){
            require 'connect.php';
            mysqli_set_charset($connect, 'UTF8');

            $ten_dang_nhap = $_GET['ten_dang_nhap'];
            $mat_khau = $_GET['mat_khau'];

            $sql = "SELECT * FROM `nhan_vien` WHERE ten_dang_nhap = '$ten_dang_nhap' and mat_khau = '$mat_khau'";
            $result = $connect->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                session_start();
                $_SESSION['ten_dang_nhap'] = $ten_dang_nhap;
                header('location: ../html/home.html');
            }
            else{
                echo 'thông tin đăng nhập không chính xác';
            }
        }
    ?>
</body>
</html>