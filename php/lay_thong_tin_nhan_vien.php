<?php
    require 'connect.php';
    mysqli_set_charset($connect,'utf8');
    echo"
    <h4 class='tieu_de'>Thông tin chi tiết</h4>";
    $ten=$_GET['ten'];
    $select_thong_tin_thanh_vien = $connect->query("SELECT `cccd`, `ten`, `ten_dang_nhap`, `mat_khau`, `sdt`, `email`, `ten_chuc_vu`, `ten_gioi_tinh`, `ngay_sinh`, `anh_dai_dien`, `dia_chi` FROM `nhan_vien`
    INNER JOIN chuc_vu ON chuc_vu.chuc_vu_id=nhan_vien.chuc_vu_id
    INNER JOIN gioi_tinh ON gioi_tinh.gioi_tinh_id=nhan_vien.gioi_tinh_id
    WHERE ten='$ten'");
    if($select_thong_tin_thanh_vien->num_rows>0){
        while($row = $select_thong_tin_thanh_vien->fetch_assoc()){
            echo "
                
                <div class='ten' id ='ten_chi_tiet'>
                <img width='100px' src='../image/upload/".$row['anh_dai_dien']."'></br>".
                "Tên:".$row['ten']."</br>
                Chức vụ:".$row['ten_chuc_vu']."</br>
                Ngày sinh:".$row['ngay_sinh']."</br>
                Giới tính:".$row['ten_gioi_tinh']."</br>
                Số điện thoại:".$row['sdt']."</br>
                Email:".$row['email']."</br>
                CCCD:".$row['cccd']."</br>
                Địa chỉ:".$row['dia_chi']."</br>"
                ."
                </div>";
        }
    }
?>