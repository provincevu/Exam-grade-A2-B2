<?php
    require "connect.php";
    mysqli_set_charset($connect, "UTF8");
    $id_du_an = $_GET['id_du_an'];
    
    $connect->query("DELETE FROM `tin_nhan` WHERE id_du_an = '$id_du_an'");
    $select_cong_viec = $connect->query("SELECT * FROM `cong_viec` WHERE id_du_an = '$id_du_an'");
    if($select_cong_viec->num_rows > 0){
        while($row = $select_cong_viec->fetch_assoc()){
            $id_cong_viec = $row['id_cong_viec'];
            $connect->query("DELETE FROM `thuc_hien` WHERE id_cong_viec = '$id_cong_viec'");
            $connect->query("DELETE FROM `cong_viec` WHERE id_cong_viec = '$id_cong_viec'");
        }
    }
    $connect->query("DELETE FROM `du_an` WHERE id_du_an = '$id_du_an'");
?>