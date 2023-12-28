<?php
    require 'connect.php';
    mysqli_set_charset($connect,'utf8');
    echo '<div class="ten_du_an">';
            $id_du_an = $_GET["id_du_an"];
            $ten_du_an = (($connect->query("SELECT * FROM `du_an` WHERE id_du_an = '$id_du_an'"))->fetch_assoc())["ten_du_an"];
            echo "<h2>". $ten_du_an ."</h2>";
    echo '</div>
    <div class="noi-dung-tin-nhan" id="noi_dung_tin_nhan">';
        $select_tin_nhan = $connect->query("SELECT * FROM `tin_nhan` WHERE id_du_an='$id_du_an' ORDER BY thoi_gian");
        while ($row = $select_tin_nhan->fetch_assoc()) {
            $ban_than = $_GET["ten_dang_nhap"];
            if($row["nguoi_gui"]==$ban_than){
            echo "<div class='position-relative tn'>
                        <p class='ban-than'>".$row["noi_dung_tin_nhan"]."</p>"."<br>".
                    "</div>";
            }
            else{
                echo"<div class='position-relative tn'>
                    <p class='ten_nguoi_gui'>".$row['nguoi_gui']."</p>
                    <p class='nguoi-khac'>".$row["noi_dung_tin_nhan"]."</p>"."<br>".
                    "</div>";
            }
        }
    echo '</div>
    <div>
        <form class="nhap-tin-nhan">
            <input type="hidden" id="idda" value='. $id_du_an .'>
            <input type="hidden" id="tdn" value='. $ban_than .'>
            <input type="text" id="tin_nhan_gui" name="noi_dung_tin_nhan">
            <button id="gui_tin_nhan">gửi</button>
        </form>
    </div>';
?>