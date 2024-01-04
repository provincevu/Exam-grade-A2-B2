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
            height: 840px;
            padding-top: 23px;
            margin: 70px 0px 70px 360px;
            background-color: rgb(84, 245, 84);
        }
        .notice{
            color: red
        }
    </style>
</head>
<body>
    <?php
        session_start();
        require 'connect.php';
        mysqli_set_charset($connect, 'UTF8');
        if(!isset($_SESSION['ten_dang_nhap'])){
            die('<span class="warning">bạn không có quyền truy cập trang này! Nhấp vào <a class="here" href="login.php">đây</a> để quay về trang đăng nhập</span>');
        }
    ?>
    <div class="container">
        <form method="post" class="col-4" id="form" enctype="multipart/form-data">
            <h1>SỬA THÔNG TIN CỦA BẠN</h1>
            <div class="form-group">
                Căn cước công dân:
                <input type="text" name="cccd" id="cccd" class="form-control" value="<?php echo $_SESSION['cccd'];?>">
                <span class="notice" id="tb_cccd"></span>
            </div>
            <div class="form-group">
                Tên:
                <input type="text" id="ten" class="form-control" name="ten" value="<?php echo $_SESSION['ten'];?>">
                <span class="notice" id="tb_ho_ten"></span>
            </div>
            <div class="form-group">
                Số điện thoại:
                <input type="text" id="sdt" class="form-control" name="sdt" value="<?php echo $_SESSION['sdt'];?>">
                <span class="notice" id="tb_sdt"></span>
            </div>
            <div class="form-group">
                Email:
                <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['email'];?>">
                <span class="notice" id="tb_email"></span>
            </div>
            <div class="form-group">
                Giới tính:
                <select name="gioi_tinh" id="gioi_tinh">
                    <option value="1" <?php
                        if($_SESSION['gioi_tinh'] == 1){
                            echo 'selected';
                        }
                    ?>>Nam</option>
                    <option value="2" <?php
                        if($_SESSION['gioi_tinh'] == 2){
                            echo 'selected';
                        }
                    ?>>Nữ</option>
                </select>
            </div>
            <div class="form-group">
                Ngày sinh:
                <input type="date" class="form-control" name="ngay_sinh" value="<?php echo $_SESSION['ngay_sinh'];?>">
            </div>
            <div class="form-group">
                Ảnh đại diện:<br>
                <span class="notice">*chỉ chấp nhận ảnh có đuôi png, jpg và jpeg và</span>
                <span class="notice">ảnh sẽ có hiệu lực sau khi đăng nhập lại</span>
                <input type="file" name="anh_dai_dien" id="anh_dai_dien"><br>
            </div>
            <div class="form-group">
                Địa chỉ:
                <input type="text" id="dia_chi" class="form-control" name="dia_chi" value="<?php echo $_SESSION['dia_chi'];?>">
                <span class="notice" id="tb_dia_chi"></span>
            </div>
            <input type="submit" value="xác nhận" name='edit-profile' id="submit">
        </form>
    </div>
    <?php
        if(isset($_POST['edit-profile'])){
            $ten_dang_nhap = $_SESSION['ten_dang_nhap'];
            $ten = $_POST['ten'];
            $cccd = $_POST['cccd'];
            $sdt = $_POST['sdt'];
            $email = $_POST['email'];
            $gioi_tinh_id = $_POST['gioi_tinh'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $dia_chi = $_POST['dia_chi'];
            $ten_anh_dai_dien = $_SESSION['anh_dai_dien'];
            //thêm ảnh
            $direct = '../image/upload/';
            $mime_file = array('image/png', 'image/jpg', 'image/jpeg');
            // Kiểm tra xem loại file có nằm trong danh sách được phép không
            if(in_array($_FILES["anh_dai_dien"]["type"], $mime_file)){
                // Tạo đường dẫn và tên file mới
                $ten_anh_dai_dien = $_FILES["anh_dai_dien"]["name"];
                $anh_dai_dien = $direct . $ten_anh_dai_dien;
                // Di chuyển tệp tải lên vào thư mục chỉ định
                move_uploaded_file($_FILES["anh_dai_dien"]["tmp_name"], $anh_dai_dien);
            }
            $sql = "UPDATE `nhan_vien` SET `cccd`='$cccd',`ten`='$ten',`sdt`='$sdt',`email`='$email',
                    `gioi_tinh_id`='$gioi_tinh_id',`ngay_sinh`='$ngay_sinh',`anh_dai_dien`='$ten_anh_dai_dien',
                    `dia_chi`='$dia_chi' WHERE `ten_dang_nhap`='$ten_dang_nhap'";
            $connect->query($sql);
            header("location: home.php");
        }
    ?>





<script>
    cccd = document.querySelector('#cccd')
    ten = document.querySelector('#ten')
    sdt = document.querySelector('#sdt')
    dia_chi = document.querySelector('#dia_chi')
    form = document.querySelector('#form')
    form.onkeyup = function(){
        document.querySelector('#submit').disabled = true
        if((ten.value.length >= 8) & (cccd.value.length >= 8) 
        & (dia_chi.value.length >= 5) & (sdt.value.length >= 10)){
            document.querySelector('#submit').disabled = false
        }
    }
    cccd.onblur = function(){
        if(cccd.value.length < 8){
            tb_cccd.innerHTML = '*vui lòng nhập chính xác căn cước công dân của bạn'
        }
        else{
            tb_cccd.innerHTML = ''
        }
    }
    dia_chi.onblur = function(){
        if(dia_chi.value.length < 5){
            tb_dia_chi.innerHTML = '*vui lòng nhập chính xác địa chỉ của bạn'
        }
        else{
            tb_dia_chi.innerHTML = ''
        }
    }
    ten.onblur = function(){
        if (ten.value.length < 8){
            tb_ho_ten.innerHTML = '*bạn cần nhập tối thiểu 8 ký tự<br>'
        }
        else{
            tb_ho_ten.innerHTML = ''
        }
    }
    sdt.onblur = function(){
        if (sdt.value.length < 9){
            tb_sdt.innerHTML = '*vui lòng nhập chính xác số điện thoại của bạn<br>'
        }
        else{
            tb_sdt.innerHTML = ''
        }
    }
</script>
</body>
</html>