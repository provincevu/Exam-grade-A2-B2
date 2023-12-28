<?php
    require 'connect.php';
    mysqli_set_charset($connect, 'UTF8');
    $id_du_an = $_GET['id_du_an'];
    $nguoi_gui = $_GET['ten_dang_nhap'];
    $noi_dung = $_GET['noi_dung'];

    $connect->query("INSERT INTO `tin_nhan`(`id_du_an`, `nguoi_gui`,  `noi_dung_tin_nhan`) VALUES ('$id_du_an','$nguoi_gui','$noi_dung')");
?>