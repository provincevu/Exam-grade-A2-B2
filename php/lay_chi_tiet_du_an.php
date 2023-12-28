<?php
    require "connect.php";
    mysqli_set_charset($connect, "UTF8");
    $moment = date("Y-m-d");
    $id_du_an = $_GET["id_du_an"];
    $ten_du_an = (($connect->query("SELECT * FROM `du_an` WHERE id_du_an = $id_du_an"))->fetch_assoc())["ten_du_an"];
    $cong_viec_data = $connect->query("SELECT * FROM `cong_viec` WHERE id_du_an = $id_du_an");
    $nums_comming = (($connect->query("SELECT COUNT(*) AS nums_comming FROM cong_viec WHERE cong_viec.ngay_bat_dau > CURRENT_DATE() AND id_du_an = $id_du_an"))->fetch_assoc())["nums_comming"];
    $nums_todo = (($connect->query("SELECT COUNT(*) AS nums_todo FROM cong_viec WHERE ngay_bat_dau <= CURRENT_DATE() AND ngay_ket_thuc >= CURRENT_DATE() AND id_du_an = $id_du_an"))->fetch_assoc())["nums_todo"];
    $nums_completed = (($connect->query("SELECT COUNT(*) AS nums_completed FROM cong_viec WHERE ngay_bat_dau <= CURRENT_DATE() AND ngay_ket_thuc < CURRENT_DATE() AND id_du_an = $id_du_an"))->fetch_assoc())["nums_completed"];
    if($cong_viec_data->num_rows > 0){
      echo '<div class="project-detail-name">
                <h3>'. $ten_du_an .'</h3>
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
                        if($requirement["ngay_bat_dau"] <= $moment && $requirement['ngay_ket_thuc'] < $moment){
                            $phan_loai = $requirement['phan_loai'];
                            $label = (($connect->query("SELECT * FROM `loai_cong_viec` WHERE id = '$phan_loai'"))->fetch_assoc())['bieu_tuong'];
                          echo '<div class="bg-light col-11 ml-3 to-do-child">
                                    <p class="requirement">'. $requirement['noi_dung'] .'</p>
                                    '. $label .'
                                </div>';
                        }
                    }
                echo '</div>
            </div>';
    }
?>