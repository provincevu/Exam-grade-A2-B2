<?php
    if(isset($_POST['add_project'])){
        $ten_du_an = $_POST['ten_du_an'];
        $nguoi_quan_ly = $_POST['nguoi_quan_ly'];
        $start_day = $_POST['start_day'];
        $end_day = $_POST['end_day'];
        $id_du_an = $_POST['id_du_an'];
        
        $connect->query("INSERT INTO `du_an`(`ten_du_an`, `nguoi_quan_ly`, `ngay_bat_dau`, `ngay_ket_thuc`) 
                        VALUES ('$ten_du_an','$nguoi_quan_ly','$start_day','$end_day')");
        echo 'Thêm dự án thành công';
    }
?>