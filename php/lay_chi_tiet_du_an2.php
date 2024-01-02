<?php
    session_start();
    require "connect.php";
    mysqli_set_charset($connect, "UTF8");
    $moment = date("Y-m-d");
    $ten_du_an = $_GET["ten_du_an"];
    $ten_dang_nhap = $_SESSION['ten_dang_nhap'];
    $self = '<i class="fa-solid fa-user label-self"></i>';
    $du_an = ($connect->query("SELECT *, HOUR(du_an.ngay_khoi_tao) AS hour,MINUTE(du_an.ngay_khoi_tao) AS minute FROM `thuc_hien`
                                    INNER JOIN cong_viec ON thuc_hien.id_cong_viec = cong_viec.id_cong_viec
                                    INNER JOIN du_an ON cong_viec.id_du_an = du_an.id_du_an
                                    WHERE thuc_hien.ten_dang_nhap = '$ten_dang_nhap' AND ten_du_an = '$ten_du_an' GROUP BY du_an.id_du_an"));
    if($du_an->num_rows > 0){
        $du_an_data = $du_an->fetch_assoc();
        $id_du_an = $du_an_data['id_du_an'];
        $cong_viec_data = $connect->query("SELECT * FROM `cong_viec` WHERE id_du_an = $id_du_an");
        $nums_comming = (($connect->query("SELECT COUNT(*) AS nums_comming FROM cong_viec WHERE cong_viec.ngay_bat_dau > CURRENT_DATE() AND id_du_an = $id_du_an"))->fetch_assoc())["nums_comming"];
        $nums_todo = (($connect->query("SELECT COUNT(*) AS nums_todo FROM cong_viec WHERE ngay_bat_dau <= CURRENT_DATE() AND ngay_ket_thuc >= CURRENT_DATE() AND id_du_an = $id_du_an"))->fetch_assoc())["nums_todo"];
        $nums_completed = (($connect->query("SELECT COUNT(*) AS nums_completed FROM cong_viec WHERE ngay_bat_dau <= CURRENT_DATE() AND ngay_ket_thuc < CURRENT_DATE() AND id_du_an = $id_du_an"))->fetch_assoc())["nums_completed"];
        if($cong_viec_data->num_rows > 0){
            echo '<div class="project-detail-name">
                        <h3>'. $du_an_data['ten_du_an'] .'</h3>
                        <i>kết thúc vào 23h59 ngày '. $du_an_data['ngay_ket_thuc'] .'</i>
                    </div>
                    <div class="projects-progress justify-content-around" id="project_progress">
                        <div class="is_comming bg-projects">
                            <b class="progress-status">IS COMMING <span class="nums_requirement">'. $nums_comming .'</span></b>';
                        while($requirement = $cong_viec_data->fetch_assoc()){
                            if($requirement["ngay_bat_dau"] > $moment){
                                $phan_loai = $requirement['phan_loai'];
                                $label = (($connect->query("SELECT * FROM `loai_cong_viec` WHERE id = '$phan_loai'"))->fetch_assoc())['bieu_tuong'];
                            echo '<div class="bg-light col-11 ml-3 comming-child">
                                        <p class="requirement">'. $requirement['noi_dung'] .'</p>
                                        '. $label .'
                                    </div>';
                            }
                        }
                        echo '</div>
                        <div class="to_do bg-projects">
                            <b class="progress-status">TO DO <span class="nums_requirement">'. $nums_todo .'</span></b>';
                            $cong_viec_data = $connect->query("SELECT * FROM `cong_viec` WHERE id_du_an = $id_du_an");
                            while($requirement = $cong_viec_data->fetch_assoc()){
                                if($requirement["ngay_bat_dau"] <= $moment && $requirement['ngay_ket_thuc'] >= $moment){
                                    $phan_loai = $requirement['phan_loai'];
                                    $label = (($connect->query("SELECT * FROM `loai_cong_viec` WHERE id = '$phan_loai'"))->fetch_assoc())['bieu_tuong'];
                                echo '<div class="bg-light col-11 ml-3 to-do-child">
                                            <p class="requirement">'. $requirement['noi_dung'] .'</p>
                                            '. $label .'
                                        </div>';
                                }
                            }
                        echo '</div>
                        <div class="completed bg-projects">
                            <b class="progress-status">COMPLETED <span class="nums_requirement">'. $nums_completed .'</span></b>';
                            $cong_viec_data = $connect->query("SELECT * FROM `cong_viec` WHERE id_du_an = $id_du_an");
                            while($requirement = $cong_viec_data->fetch_assoc()){
                                $id_cong_viec = $requirement['id_cong_viec'];
                                if($requirement["ngay_bat_dau"] <= $moment && $requirement['ngay_ket_thuc'] < $moment){
                                    $phan_loai = $requirement['phan_loai'];
                                    $label = (($connect->query("SELECT * FROM `loai_cong_viec` WHERE id = '$phan_loai'"))->fetch_assoc())['bieu_tuong'];
                                echo '<div class="bg-light col-11 ml-3 to-do-child">
                                            <p class="requirement">'. $requirement['noi_dung'] .'</p>
                                            '. $label;
                                    $thuc_hien_data = $connect->query("SELECT * FROM `thuc_hien` WHERE id_cong_viec = '$id_cong_viec'");
                                    while($rows = $thuc_hien_data->fetch_assoc()){
                                        if ($rows['ten_dang_nhap']){
                                            echo $self;
                                        }
                                    }
                                echo '</div>';
                                }
                            }
                        echo '</div>
                    </div>';
            }
    }
    else{
        echo '<h1>không có dự án mà bạn muốn tìm, vui lòng thử lại</h1>';
    }
?>