<?php
    require 'connect.php';
    mysqli_set_charset($connect, 'UTF8');
    $ten_du_an = '$_GET['ten_du_an']';
    $id_du_an = (($connect->query("SELECT * FROM `du_an` WHERE ten_du_an = '$ten_du_an'"))->fetch_assoc())['id_du_an'];
    echo $id_du_an;
?>