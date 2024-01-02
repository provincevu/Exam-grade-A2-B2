<?php
    require "connect.php";
    mysqli_set_charset($connect, "UTF8");
    $ten_du_an = $_GET['ten_du_an'];
    $start_day = $_GET['start_day'];
    $end_day = $_GET['end_day'];
    
    $connect->query("INSERT INTO `du_an`(`ten_du_an`, `ngay_bat_dau`, `ngay_ket_thuc`) 
                    VALUES ('$ten_du_an','$start_day','$end_day')");
?>