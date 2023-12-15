<?php
    require 'connect.php';
    mysqli_set_charset($connect, 'UTF8');
    $moment = date('Y-m-d');
    $select_du_an = $connect->query("SELECT ten_du_an, nguoi_quan_ly, ngay_bat_dau, ngay_ket_thuc,
                    HOUR(du_an.ngay_khoi_tao) AS hour,MINUTE(du_an.ngay_khoi_tao) AS minute FROM du_an;");
    while($du_an = $select_du_an->fetch_assoc()){
        echo "
        <div class='project-info' >";
        if ($du_an['ngay_bat_dau'] > $moment){
            echo 'project_is_comming';
        }
        elseif($du_an['ngay_ket_thuc'] >= $moment){
            echo 'project_to_do';
        }
        else{
            echo 'project_completed';
        }
        echo "
            <div class='start-day mt-3'>
                <b>". $du_an['ngay_bat_dau'] ."</b>
            </div>
            <div class='project-name'>
                <h4>". $du_an['ten_du_an'] ."</h4>
                <p>submitted at ". $du_an['hour'] .":". $du_an['minute'] ."</p>
            </div>
        </div>
        ";
    }
?>