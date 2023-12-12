<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <style>
        form{
            border: 1px solid rgb(129, 129, 224);
            height: auto;
            padding: 23px 0px 30px 0px;
            margin: 70px 0px 70px 360px;
            background-color: rgb(84, 245, 84);
        }
        input, select{
            margin-top: 5px;
        }
        .notice{
            color: red
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            document.querySelector('#submit').disabled = true
            ho_ten = document.querySelector('#ho_ten')
            tb_ho_ten = document.querySelector('#tb_ho_ten')
            cccd = document.querySelector('#cccd')
            tb_cccd = document.querySelector('#tb_cccd')
            dia_chi = document.querySelector('#dia_chi')
            tb_dia_chi = document.querySelector('#tb_dia_chi')
            sdt = document.querySelector('#sdt')
            tb_sdt = document.querySelector('#tb_sdt')
            ten_dang_nhap = document.querySelector('#ten_dang_nhap')
            tb_ten_dang_nhap = document.querySelector('#tb_ten_dang_nhap')
            password = document.querySelector('#password')
            nhap_lai_password = document.querySelector('#nhap_lai_password')
            tb_nhap_lai_password = document.querySelector('#tb_nhap_lai_password')
            email = document.querySelector('#email')
            tb_email = document.querySelector('#tb_email')
            tra_loi = document.querySelector('#tra_loi')
            tb_tra_loi = document.querySelector('#tb_tra_loi')
            form.onkeyup = function(){
                if((ho_ten.value.length >= 8) & (ten_dang_nhap.value.length >= 8) & (password.value === nhap_lai_password.value)
                & (email.value.includes('@') !== false) & (cccd.value.length >= 8) & (dia_chi.value.length >= 5)
                & (sdt.value.length >= 10) & (password.value.length >= 6)){
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
            password.onblur = function(){
                if(password.value.length < 6){
                    tb_password.innerHTML = '*độ dài tối thiểu của mật khẩu là 6'
                }
                else{
                    tb_password.innerHTML = ''
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
            ho_ten.onblur = function(){
                if (ho_ten.value.length < 8){
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
            ten_dang_nhap.onblur = function(){
                if (ten_dang_nhap.value.length < 8){
                    tb_ten_dang_nhap.innerHTML = '*bạn cần nhập tối thiểu 8 ký tự<br>'
                }
                else{
                    tb_ten_dang_nhap.innerHTML = ''
                }
            }
            nhap_lai_password.onblur = function(){
                if (password.value !== nhap_lai_password.value){
                    tb_nhap_lai_password.innerHTML = '*vui lòng nhập mật khẩu xác nhận trùng khớp với mật khẩu bên trên<br>'
                }
                else{
                    tb_nhap_lai_password.innerHTML = ''
                }
            }
            email.onblur = function(){
                if (email.value.includes('@') === false){
                    tb_email.innerHTML = '*vui lòng nhập đúng email của bạn<br>'
                }
                else{
                    tb_email.innerHTML = ''
                }
            }
        })
    </script>
</head>
<body>
    <div class="container">
        <form method="get" class="col-4" id='form' class="form-signup">
            <h1>TẠO TÀI KHOẢN</h1>
            <div class="form-group">
                Căn cước công dân(*):
                <input type="text" name="cccd" class="form-control" id='cccd' placeholder="nhập căn cước công dân của bạn">
                <span class="notice" id="tb_cccd"></span>
            </div>
            <div class="form-group">
                Họ tên(*):
                <input type="text" name="ten" class="form-control" id="ho_ten" placeholder="nhập tên của bạn">
                <span class="notice" id="tb_ho_ten"></span>
            </div>
            <div class="form-group">
                Tên đăng nhập(*):
                <input type="text" name="ten_dang_nhap" class="form-control" id="ten_dang_nhap" placeholder="nhập tên đăng nhập muốn tạo">
                <span class="notice" id="tb_ten_dang_nhap"></span>
            </div>
            <div class="form-group">
                Mật khẩu(*):
                <input type="password" name="mat_khau" class="form-control" id="password" placeholder="nhập mật khẩu của bạn">
                <span class="notice" id="tb_password"></span>
            </div>
            <div class="form-group">
                Nhập lại mật khẩu(*):
                <input type="password" name="nhap_lai_mat_khau" class="form-control" id="nhap_lai_password" placeholder="xác nhận mật khẩu của bạn">
                <span class="notice" id="tb_nhap_lai_password"></span>
            </div>
            <div class="form-group">
                Giới tính(*):
                <select name="gioi_tinh" id="gioi_tinh">
                    <option value="1">Nam</option>
                    <option value="2">Nữ</option>
                </select>
            </div>
            <div class="form-group">
                Email(*):
                <input type="email" class="form-control" id="email" name="email" placeholder="nhập email của bạn">
                <span class="notice" id="tb_email"></span>
            </div>
            <div class="form-group">
                Số điện thoại(*):
                <input type="text" class="form-control" name="sdt" id="sdt" placeholder="nhập số điện thoại của bạn">
                <span class="notice" id="tb_sdt"></span>
            </div>
            <div class="form-group">
                Ngày sinh(*):
                <input type="date" class="form-control" name="ngay_sinh">
            </div>
            <div class="form-group">
                Địa chỉ(*):
                <input type="text" class="form-control" name="dia_chi" id="dia_chi" placeholder="nhập địa chỉ nơi ở hiện tại của bạn">
                <span class="notice" id="tb_dia_chi"></span>
            </div>
            <a href="login.php">Đăng Nhập</a>
            <input type="submit" value="Đăng Ký" id='submit' name='sign_up'>
        </form>
    </div>
    <?php
        if(isset($_GET['sign_up'])){
            require 'connect.php';
            mysqli_set_charset($connect, 'UTF8');

            $cccd = $_GET['cccd'];
            $ten = $_GET['ten'];
            $ten_dang_nhap = $_GET['ten_dang_nhap'];
            $mat_khau = $_GET['mat_khau'];
            $gioi_tinh_id = $_GET['gioi_tinh'];
            $email = $_GET['email'];
            $sdt = $_GET['sdt'];
            $ngay_sinh = $_GET['ngay_sinh'];
            $dia_chi = $_GET['dia_chi'];

            $sql = "INSERT INTO `nhan_vien`(`cccd`, `ten`, `ten_dang_nhap`, `mat_khau`, `sdt`, `email`, `gioi_tinh_id`, `ngay_sinh`, `dia_chi`) 
                    VALUES ('$cccd','$ten','$ten_dang_nhap','$mat_khau','$sdt','$email','$gioi_tinh_id','$ngay_sinh','$dia_chi')";

            if($connect->query($sql)){
                echo 'đăng ký tài khoản thành công, vui lòng đăng nhập để sử dụng';
            }
            else{
                echo 'đăng ký không thành công! Lỗi:' . $connect->error;
            }
            
        }
    ?>
</body>
</html>
