<?php
    session_start();
    if(!isset($_SESSION['ten_dang_nhap'])){
        die('<span class="warning">bạn không có quyền truy cập trang này! Nhấp vào <a class="here" href="login.php">đây</a> để quay về trang đăng nhập</span>');
    }
    else{
        unset($_SESSION['ten_dang_nhap']);
        unset($_SESSION['ten']);
        unset($_SESSION['cccd']);
        unset($_SESSION['mat_khau']);
        unset($_SESSION['sdt']);
        unset($_SESSION['email']);
        unset($_SESSION['gioi_tinh']);
        unset($_SESSION['ngay_sinh']);
        unset($_SESSION['anh_dai_dien']);
        unset($_SESSION['dia_chi']);
    }
    header('location: login.php')
?>