<?php
    require 'connect.php';
    mysqli_set_charset($connect, 'UTF8');
    $noi_dung_yeu_cau = $_GET['yeu_cau'];
    $id_du_an = $_GET['id_du_an'];

    $connect->query("INSERT INTO `yeu_cau`(`id_du_an`, `noi_dung_yeu_cau`) VALUES ('$id_du_an','$noi_dung_yeu_cau')");
?>