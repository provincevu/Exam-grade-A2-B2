<?php
    require 'connect.php';
    mysqli_set_charset($connect, 'UTF8');
    $id_du_an = $_GET['id_du_an'];
    $noi_dung = $_GET['noi_dung'];
    $phan_loai = $_GET['phan_loai'];
    $ngay_bat_dau = $_GET['ngay_bat_dau'];
    $ngay_ket_thuc = $_GET['ngay_ket_thuc'];
    $connect->query("INSERT INTO `cong_viec`(`id_du_an`, `noi_dung`, `phan_loai`, `ngay_bat_dau`, `ngay_ket_thuc`) 
                    VALUES ('$id_du_an','$noi_dung','$phan_loai','$ngay_bat_dau','$ngay_ket_thuc')") ;



    
?>