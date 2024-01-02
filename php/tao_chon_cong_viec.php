<?php
    require 'connect.php';
    mysqli_set_charset($connect, 'UTF8');
    $id_du_an = $_GET['id_du_an'];
    $sql = "SELECT * FROM `cong_viec` WHERE id_du_an = '$id_du_an'";
    $cong_viec = $connect->query($sql);
    if ($cong_viec->num_rows > 0){
        while($cv = $cong_viec->fetch_assoc()){
            $id_cong_viec = $cv['id_cong_viec'];
            $noi_dung = $cv['noi_dung'];
            echo "<option value=$id_cong_viec>$noi_dung</option>";
        }
    }
    else{
        echo '<option>không có dữ liệu</option>';
    }
?>