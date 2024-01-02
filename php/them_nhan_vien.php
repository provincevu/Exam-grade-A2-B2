<?php
    require 'connect.php';
    mysqli_set_charset($connect, 'UTF8');
    $id_cong_viec = $_GET['id_cong_viec'];
    $id_du_an = $_GET['id_du_an'];
    $ten_dang_nhap = $_GET['ten_dang_nhap'];
    $connect->query("INSERT INTO `thuc_hien`(`id_cong_viec`, `ten_dang_nhap`) 
                    VALUES ('$id_cong_viec','$ten_dang_nhap')") ;

    $connect->query("INSERT INTO `tin_nhan`(`id_du_an`, `nguoi_gui`) VALUES ('$id_du_an','$ten_dang_nhap')");
?>