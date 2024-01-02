<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <?php
        session_start();
        require 'connect.php';
        mysqli_set_charset($connect, 'UTF8');
        if(!isset($_SESSION['ten_dang_nhap'])){
            die('<span class="warning">bạn không có quyền truy cập trang này! Nhấp vào <a class="here" href="login.php">đây</a> để quay về trang đăng nhập</span>');
        }
    ?>
    <style>
        body{
            position: relative;
        }
        .projects-progress{
            display: grid;
            grid-auto-flow: row;
            grid-template-columns: 30% 30% 30%;
        }

        #projects{
            background-color: rgb(76, 155, 235);
        }

        /* phần cần gỡ */
        .projects{
            padding-bottom: 30px;
            display: block
        }

        .status{
            padding: 10px 0px 15px 30px;
        }

        #is_comming, #to_do, #completed{
            font-weight: bold;
            cursor: pointer;
            display: block;
        }
        
        .start-day b{
            font-weight: bold;
            font-size: 130%;
        }

        .project-info{
            width: 95%;
            margin: 20px 0px 0px 30px;
        }
        .project-name{
            background-color: white;
            height: 100px;
            border: 1px solid rgb(214, 207, 207);
            border-radius: 7px;
            padding: 10px 0px 0px 20px;
            cursor: pointer;
        }

        .project-status{
            display: grid;
            border-bottom: 1px solid rgb(226, 223, 223);
            grid-template-columns: 13% 8% 12%;
        }

        .bg-projects{
            background-color: rgb(241, 236, 236);
            border-radius: 5px
        }
        .progress-status{
            margin: 20px 0px 0px 10px;
            display: block;
            color: rgb(143, 143, 143);
            font-size: 90%;
            font-weight: bold;
        }
        .nums_requirement{
            font-weight: 400;
        }
        
        .comming-child, .to-do-child, .completed-child{
            margin-top: 20px;
            margin-bottom: 20px;
            height: 170px;
        }
        .comming-child p, .to-do-child p, .completed-child p {
            word-wrap: break-word; /* Cho phép tự động xuống dòng khi cần thiết */
        }
        .content{
            font-size: 130%;
            height: 657px;
            overflow: auto;
            z-index: 6;
            padding: 0%;
        }
        #project_to_do, #project_completed{
            display: none;
        }

        #is_comming{
            border-bottom: 5px solid grey;
        }

        .add_project{
            color: black;
        }
        .add_project:hover{
            text-decoration: none;
            color: black;
        }

        .project-detail-name{
            padding: 18px;
        }

        .project-detail-name i{
            font-size: 80%;
            color: rgb(114, 110, 110);
        }

        .label-requirement{
            position: absolute;
            bottom: 15px;
            left: 25px;
        }

        .label-self{
            position: absolute;
            bottom: 15px;
            right: 25px;
        }
        .div_add_project{
            background-image: url('../image/add_project.jpg');
            background-size: 100%;
            background-attachment: fixed;
            height: 656px;
            display: none;
        }
        #form_add_project{
            opacity: 0.83;
            padding: 9% 0% 0% 22%;
        }
        #form_add_project input{
            height: 55px;
            border-radius: 15px;
            margin-bottom: 17px;
            border: 1px solid white;
            padding: 0px 7px 0px 10px;
            width: 70%;
        }
        #form_add_project input:focus{
            outline: none;
        }
        #form_add_project p{
            margin-bottom: 0px;
        }
        #form_add_project .add{
            margin-left: -26px;
            cursor: pointer;
        }
        #form_add_project #button_add_project{
            background-color: rgb(84, 227, 84);
            margin-bottom: 150px;
        }
        #form_add_project ul{
            font-size: 85%;
        }
        #form_add_project span{
            color: red;
            font-size: 90%;
            margin: 0px;
            height: 5px;
        }
        .tb_add{
            position: absolute;
            top: 0
        }


        .update_and_remove{
            display: none;
        }
        .update_and_remove h1{
            margin: 20px 0px 20px 20px;
            font-weight: bold
        }
        .update_and_remove a{
            display: block;
            text-decoration: none;
            color: black;
        }
        .update_and_remove table{
            border-collapse: collapse;
            margin-left: 6%;
        }
        .update_and_remove tr:hover{
            background-color: orange;
        }
        .update_and_remove th{
            height: 40px;
        }
        .td_name{
            width: 580px;
            height: 30px;
        }
        .days{
            width: 19%;
        }
        .update_and_remove .bg-lb{
            background-color: lightblue
        }
        .update_and_remove .bg-yellow{
            background-color: lightyellow
        }
        .update_and_remove caption{
            font-weight: bold;
            font-size: 130%
        }
        .button_remove{
            cursor: pointer;
        }

        .confirm_delete{
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(0, 0, 0,0.7);
            display: none
        }

        .confirm_delete div{
            width: 30%;
            height: 30%;
            background-color: white;
            margin: 15% 0% 0% 36%;
            padding-top: 35px

        }

        .confirm_button{
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: rgb(0,123,255);
            color: #fff;
            cursor: pointer;
        }
        .confirm_button:hover{
            background-color: rgb(5, 87, 175);
        }

        .cancel_button{
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: rgb(189, 172, 172);
            color: rgb(69, 61, 61);
            cursor: pointer;
        }
        .cancel_button:hover{
            background-color: rgb(106, 100, 100);
        }

        .confirm_delete p{
            margin-bottom: 20px;
        }
        .end_td{
            padding: 0
        }
        .hid{
            display: none
        }










    /* phần này của Minh */
    .ten_du_an{
        border-bottom: 1px solid black;
        padding-left: 20px
    }
    .them_cong_viec{
        height: 655px;
        padding: 30px 30px 0px 30px;
        display: none;
    }
    .tieu_de{
        padding:30px 30px 0px 30px;
        color: red;

    }
    .thong_tin_cong_viec{
        font-size: 90%
    }
    .save_work{
        position: fixed;
        bottom: 3%;
        left: 27%
    }











        /* Phần này của Hải */


        /* Thành viên */
        .cac_thanh_vien{
            padding-left: 20px;
            padding-bottom:20px;
            display: none;
        }
        .tieu_de{
            position: relative;
            border-bottom: 1px solid black;
            padding-left: 30px;
            padding-bottom:10px;
        }
        .ten{
            cursor: pointer;
        }
        #ten_chi_tiet{
            text-align: center;
        }
        .anh{
            padding-top: 20px;
        }
        .khung{
            border: 5px solid black;
            align :center;
        }
/* Trao đổi tin nhăn */





.ten_du_an{
            border-bottom: 1px solid black;
            padding-left: 20px
        }
        .cac_tin_nhan{
            height: 500px;
            padding: 30px 30px 0px 30px;
            display: none;
        }
        .chi-tiet-tin-nhan{
            position: relative;
        }
        .noi-dung-tin-nhan{
            height: 550px;
            overflow:auto;
        }

        .tin-nhan{
            background-color: white;
            height: 100px;
            border: 1px solid rgb(214, 207, 207);
            border-radius: 7px;
            padding: 10px 0px 0px 20px;
            cursor: pointer;
        }

        .nhap-tin-nhan{
            position: fixed;
            bottom: 20px;
            left: 30%;
            width: 67%;
        }
        .nhap-tin-nhan input{
            width: 91%
        }

        .nguoi-khac{
            display: inline-block;
            border-radius:15px;
            padding: 5px 20px 5px 20px;
            max-width: 50%;
            border: 1px solid black;
            word-wrap: break-word;
            margin: 15px 0px 0px 50px;
            background-color: rgb(234, 229, 222);
        }
        .ban-than{
            display: inline-block;
            border-radius:15px;
            padding: 5px 20px 5px 20px;
            max-width: 50%;
            border: 1px solid black;
            word-wrap: break-word;
            margin: 15px 40px 0px 800px;
            float: right; /* Canh lề phải */
            color: white;
            background-color:rgb(126, 182, 234);
        }
    
        .thong_tin_tn{
            
            display:flex;
        }

        .ten_nguoi_gui{
            position: absolute;
            left: 50px;
            top: -5px;
            font-size: 70%;
            color: rgb(120, 109, 109);

        }
        .tn{
            margin-top:40px
        }






    </style>
    <!-- <script src="../javascript/home_script.js">
    </script> -->
</head>
<body>
    <header class="container-fluid header" id="container-fluid">
        <div class="row justify-content-between bg-header">
            <div class="col-7 row test align-content-center justify-content-center">
                <div class="logo-website col-1 bg-light pl-0 pr-0">
                    <img src="..\image\logo.png" alt="logo web" class="w-100 bg-header">
                </div>
                <div class="name-website col-10">
                    <b class="color-white pj">Project</b><span class="font-timeNewRoman mt color-white">Master</span>
                </div>
            </div>
            <form method="get" class="col-4">
                <div class="row justify-content-center">
                    <div class="col-9 bg-header mt-3 position-relative">
                        <i class="fas fa-search icon-search"></i>
                        <input type="text" class="search-form" list="suggestion" placeholder="tìm kiếm nhanh công việc" id='ten_du_an'>
                        <datalist id="suggestion">
                            <?php
                                $ten_dang_nhap = $_SESSION['ten_dang_nhap'];
                                $search_data = $connect->query("SELECT * FROM `thuc_hien`
                                                                INNER JOIN cong_viec ON thuc_hien.id_cong_viec = cong_viec.id_cong_viec
                                                                INNER JOIN du_an ON cong_viec.id_du_an = du_an.id_du_an
                                                                WHERE thuc_hien.ten_dang_nhap = '$ten_dang_nhap' GROUP BY du_an.id_du_an");
                                while($data = $search_data->fetch_assoc()){
                                    echo "<option value='". $data['ten_du_an'] ."'>";
                                }
                            ?>
                        </datalist>
                    </div>
                    <div class="col-3 bg-header mt-3 pl-1"><input type="button" value="Search" class="search-button" id="search"></div>
                </div>
            </form>
            <div class="col-1 position-relative test">
                <div class="profile w-75">
                    <img src = <?php echo '../image/upload/' . $_SESSION['anh_dai_dien']?> alt="Avatar" class="avatar w-100" id="showInfo">
                </div>
                <!-- hiển thị thông tin của người dùng -->
                <div class="info color-white" id="info">
                    <div class="row ml-2 idx-top">
                        <div class="col-3 row profile">
                            <img src= <?php echo '../image/upload/' . $_SESSION['anh_dai_dien']?> alt="Avatar" class="w-100" id="showImage">
                        </div>
                        <div class="col-8 mt-3 name-user">
                            <?php echo $_SESSION['ten']; ?>
                        </div>
                    </div>
                    <div class="row ml-2 mt-3 name-user">
                        Email: <?php echo $_SESSION['email']; ?>
                    </div>
                    <div class="row ml-2 mt-3 name-user">
                        Chức vụ: 
                        <?php
                            $chuc_vu_id = $_SESSION['chuc_vu_id'];
                            $chuc_vu = ($connect->query("SELECT * FROM `chuc_vu` WHERE chuc_vu_id = '$chuc_vu_id'"))->fetch_assoc();
                            echo $chuc_vu['ten_chuc_vu']; 
                        ?>
                    </div>
                    <div class="row ml-2 mt-3 name-user">
                        Địa chỉ: <?php echo $_SESSION['dia_chi']; ?>
                    </div>
                    <div class="row border-bottom"></div>
                    <a href='edit_profile.php'>
                        <div class="font-120 row" id='edit-profile'>
                            <div class="col-2"><i class="fa-solid fa-gear mt-2 ml-3"></i></div>
                            <p>Chỉnh sửa thông tin</p>
                        </div>
                    </a>
                    <a href="logout.php">
                        <div class="font-120 row" id='logout'>
                            <div class="col-2"><i class="fa-solid fa-right-from-bracket mt-2 ml-3"></i></div>
                            <p>đăng xuất</p>
                        </div>
                    </a>
                </div>
                <div class='anh_dai_dien' id='anh_dai_dien'>
                    <img src= <?php echo '../image/upload/' . $_SESSION['anh_dai_dien']?>>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid sec" id="container-fluid">
        <div class="row">
            <div class="col-3 functions">
                <div class="user-info row">
                    <div class="col-3 avatar-sm oi">
                        <img src= <?php echo '../image/upload/' . $_SESSION['anh_dai_dien']?> alt="Avatar" class="w-100 avatar2 mt-1 mb-1">
                    </div>
                    <div class="information">
                        <div class="information">
                            <p class="name-user">
                                <?php
                                    echo $_SESSION['ten'];
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="list-functions">
                    <b class="title-function">chức năng</b>
                    <div class="row function-item">
                        <i class="fa-solid fa-house col-2 logo-function"></i>
                        <p class="col-10 pl-2 name-function" id="projects">Các dự án</p>
                    </div>
                    <div class="row function-item">
                        <i class="fa-solid fa-user-group col-2 logo-function"></i>
                        <p class="col-10 pl-2 name-function" id="members">Thành viên</p>
                    </div>
                    <div class="row function-item">
                        <i class="fa-solid fa-message col-2 logo-function"></i>
                        <p class="col-10 pl-2 name-function" id="discuss">Trao đổi công việc</p>
                    </div>
                    <?php
                        if($_SESSION['chuc_vu_id'] == 2){
                            echo '<div class="row function-item">
                                    <i class="fa-solid fa-briefcase col-2 logo-function"></i>
                                    <p class="col-10 pl-2 name-function" id="add_work">Thêm công việc</p>
                                </div>';
                        }
                        else{
                            echo '<div class="row function-item hid">
                                    <i class="fa-solid fa-briefcase col-2 logo-function"></i>
                                    <p class="col-10 pl-2 name-function" id="add_work">Thêm công việc</p>
                                </div>';
                        }
                        if($_SESSION['chuc_vu_id'] == 3){
                            echo '<div class="row function-item">
                                     <i class="fa-solid fa-briefcase col-2 logo-function"></i>
                                     <p class="col-10 pl-2 name-function" id="add_project">Thêm dự án</p>
                                 </div>';
                            echo '<div class="row function-item">
                                <i class="fa-solid fa-trash col-2 logo-function"></i>
                                <p class="col-10 pl-2 name-function" id="remove_project">Sửa và xóa dự án</p>
                            </div>';
                        }
                        else{
                            echo '<div class="row function-item hid">
                                     <i class="fa-solid fa-briefcase col-2 logo-function"></i>
                                     <p class="col-10 pl-2 name-function" id="add_project">Thêm dự án</p>
                                 </div>';
                            echo '<div class="row function-item hid">
                                <i class="fa-solid fa-trash col-2 logo-function"></i>
                                <p class="col-10 pl-2 name-function" id="remove_project">Sửa và xóa dự án</p>
                            </div>';
                        }
                    ?>
                </div>
            </div>
            <div class="col-9 content position-relative">
                <div class="projects bg-projects" id='project_content'>
                    <div class="project-status">
                        <div class="status">
                            <b id="is_comming">Is comming</b>
                        </div>
                        <div class="status">
                            <b id="to_do">to do</b>
                        </div>
                        <div class="status">
                            <b id="completed">completed</b>
                        </div>
                    </div>
                    <div class="project-list">
                        <?php
                            $moment = date('Y-m-d');
                            $select_du_an = $connect->query("SELECT *, HOUR(du_an.ngay_khoi_tao) AS hour,MINUTE(du_an.ngay_khoi_tao) AS minute FROM `thuc_hien`
                                                            INNER JOIN cong_viec ON thuc_hien.id_cong_viec = cong_viec.id_cong_viec
                                                            INNER JOIN du_an ON cong_viec.id_du_an = du_an.id_du_an
                                                            WHERE thuc_hien.ten_dang_nhap = '$ten_dang_nhap' GROUP BY du_an.id_du_an");
                            while($du_an = $select_du_an->fetch_assoc()){
                                echo "
                                <div class='project-info' id=";
                                if ($du_an['ngay_bat_dau'] > $moment){
                                    echo 'project_is_comming';
                                }
                                elseif($du_an['ngay_ket_thuc'] >= $moment){
                                    echo 'project_to_do';
                                }
                                else{
                                    echo 'project_completed';
                                }
                                echo ">
                                    <div class='start-day mt-3'>
                                        <b>". $du_an['ngay_bat_dau'] ."</b>
                                    </div>
                                    <div class='project-name' id='project_name'>
                                        <p style='display: none' id='id_du_an'>". $du_an['id_du_an'] ."</p>
                                        <h4>". $du_an['ten_du_an'] ."</h4>
                                        <p>submitted at ". $du_an['hour'] .":". $du_an['minute'] ."</p>
                                    </div>
                                </div>
                                ";
                            }
                        ?>
                    </div>
                </div>
                <div class='project-detail' id='project_detail'>
                    <!-- chỗ để dự án hiển thị -->
                </div>

                <div class="div_add_project" id='div_add_project'>
                    <form class="align-items-center" id='form_add_project'>
                        <p>Tên dự án:</p>
                        <input type="text" placeholder="Nhập tên dự án muốn thêm" id="ten_du_an_them"><br>
                        <span id="tb_ten_du_an"></span>
                        <p>Ngày bắt đầu:</p>
                        <input type="date" id="start_day"><br>
                        <p>Ngày kết thúc:</p>
                        <input type="date" id="end_day"><br>
                        <span id="tb_end_day"></span>
                        <input type="submit" value="Thêm dự án" id="button_add_project" name="add_project">
                    </form>
                </div>

                <div class='update_and_remove'>
                    <h1>THÔNG TIN CÁC DỰ ÁN</h1>
                    <table border="1px">
                        
                        <tr style='background-color: blue; color:white'>
                            <th>Tên dự án</th>
                            <th>ngày bắt đầu</th>
                            <th>ngày kết thúc</th>
                        </tr>
                        <?php
                            $sql = 'SELECT * FROM `du_an`';
                            $result = $connect->query($sql);

                            if($result->num_rows > 0){
                                $col = 0;
                                while($row = $result->fetch_assoc()){
                                    $col++;
                                    echo '<tr class=';
                                    if ($col%2 == 0){
                                        echo 'bg-lb project_information';
                                    }
                                    else{
                                        echo 'bg-yellow project_information';
                                    }
                                    echo ' id="pi">';
                                    echo '<td style="display: none" id="id_du_an_delete">'. $row['id_du_an'] .'</td>';
                                    echo '<td class="td_name"><a id="ten_du_an_info" href="update_project.php?id_du_an='. $row['id_du_an'] .'">'. $row['ten_du_an'] .'</a></td>';
                                    echo '<td class="days"><a id="ngay_bat_dau_info" href="update_project.php?id_du_an='. $row['id_du_an'] .'">'. $row['ngay_bat_dau'] .'</a></td>';
                                    echo '<td class="days"><a id="ngay_ket_thuc_info" href="update_project.php?id_du_an='. $row['id_du_an'] .'">'. $row['ngay_ket_thuc'] .'</a></td>';
                                    echo '<td class="end_td"><button class="button_remove">xóa</button></td>';
                                    echo '</tr>';
                                }
                            }
                        ?>
                    </table>
                </div>
                <div class='confirm_delete text-center' id='confirm_delete'>
                    <div>
                        <h2>XÁC NHẬN HÀNH ĐỘNG</h2>
                        <p>Bạn có chắc chắn muốn xóa dự án này không?</p>
                        <button class='confirm_button' id="confirm_button" type="submit">Xác nhận</button>
                        <button class='cancel_button' id="cancel_button" type="submit">Hủy</button>
                    </div>
                </div>







                <!-- phần này của Minh -->
                <div class="them_cong_viec bg-projects" id='them_cong_viec'>
                    <form method="get" id='form_them_cv'>
                        Vui lòng chọn dự án muốn thêm công việc: <select id="id_du_an_select">
                            <?php
                                $select_du_an_2 = $connect->query("SELECT * FROM `du_an`");
                                if($select_du_an_2->num_rows > 0){
                                    while($row = $select_du_an_2->fetch_assoc()){
                                        echo '<option value='. $row['id_du_an'] .'>'. $row['ten_du_an'] .'</option>';
                                    }
                                }
                            ?>
                        </select><br>
                        <p></p>
                        <div class='thong_tin_cong_viec mb-3' id='thong_tin_cong_viec'>
                            <input type="text" class="noi_dung_cong_viec" placeholder="nội dung công việc">
                            Loại công việc: 
                            <select class="phan_loai">
                                <option value="1">lên kế hoạch</option>
                                <option value="2">sửa chữa</option>
                                <option value="3">đánh giá</option>
                                <option value="4">phát triển</option>
                            </select>
                            ngày bắt đầu:
                            <input type="date" class="start" placeholder="ngày bắt đầu">
                            ngày kết thúc:
                            <input type="date" class="end" placeholder="ngày kết thúc"><br>
                        </div>
                    </form>
                    <button class='mt-2' id='them_cv'>thêm công việc</button>
                    <button class='save_work' id='save_work'>Lưu thay đổi</button>
                </div>




                <!-- phần của hải -->
                <!-- phần thành viên-->

                <div class="cac_thanh_vien " id="cac_thanh_vien">
                    <h4 class="tieu_de">Tên các thành viên trong công ty</h4>
                    <?php
                        $select_thanh_vien = $connect->query("SELECT * FROM `nhan_vien`");
                        if($select_thanh_vien->num_rows>0){
                            while($row = $select_thanh_vien->fetch_assoc()){
                                echo "
                                    <img src='../image/upload/".$row['anh_dai_dien']."' class='anh' width='100px'>
                                    <div class='ten'>
                                        <b id='ten'>".$row['ten']."</b>
                                    </div>";
                            }
                        }
                        
                    ?>
                </div>
                <div class="thong_tin_thanh_vien" id='thong_tin'>
                        <!--thông tin chi tiết nhân viên-->
                </div>

                <!-- phần trao đổi công việc-->


                <div class="cac_tin_nhan bg-projects" id='cac_tin_nhan'>
                    <?php
                        $nguoi_gui = $_SESSION['ten_dang_nhap'];
                        $select_nguoi_gui = $connect->query("SELECT DISTINCT id_du_an FROM `tin_nhan` where nguoi_gui = '$nguoi_gui'");
                        if($select_nguoi_gui->num_rows > 0){
                            while($row = $select_nguoi_gui->fetch_assoc()){
                                $id_du_an = $row['id_du_an'];
                                $du_an = ($connect->query("SELECT * FROM `du_an` WHERE id_du_an = '$id_du_an'"))->fetch_assoc();
                                echo "
                                <div class='thong-tin-du-an'>
                                    <div class='tin-nhan' id='tin_nhan'>
                                        <p style='display: none' id='nguoi_gui'>". $nguoi_gui ."</p>
                                        <p style='display: none' id='id_da'>". $du_an['id_du_an'] ."</p>
                                        <h4>". $du_an['ten_du_an'] ."</h4>
                                    </div>
                                </div>
                                ";
                            }
                        }
                    ?>
                </div>
                <div class="chi-tiet-tin-nhan" id='chi_tiet_tin_nhan'>
                    <!-- đây là phần hiện chi tiết tin nhắn -->
                </div>

                <div>
                    <!-- đây là phần để thêm nội dung mới -->
                </div>
            </div>
        </div>
    </div>





    <script>
    document.addEventListener('click', function(e){
        //hiện info
        const info = document.querySelector('#info');
        const showInfo = document.querySelector('#showInfo');

        if (e.target !== showInfo && !info.contains(e.target)) {
            info.style.display = 'none';
        } 
        if (e.target === showInfo) {
            info.style.display = 'block';
        }

        //hiện ảnh
        const anh_dai_dien = document.querySelector('#anh_dai_dien');
        const showImage = document.querySelector('#showImage');

        if (e.target !== showImage && !anh_dai_dien.contains(e.target)) {
            anh_dai_dien.style.display = 'none';
        } 
        if (e.target === showImage) {
            anh_dai_dien.style.display = 'block';
        }

        //đổi màu function + hiển thị
        const projects = document.querySelector('#projects');
        const members = document.querySelector('#members');
        const discuss = document.querySelector('#discuss');
        const project_content = document.querySelector('#project_content');
        const add_project = document.querySelector('#add_project');
        const div_add_project = document.querySelector('#div_add_project');
        const update_and_remove = document.querySelector('.update_and_remove');
        const remove_project = document.querySelector('#remove_project');
        const cac_tin_nhan = document.querySelector('#cac_tin_nhan');
        const cac_thanh_vien = document.querySelector('#cac_thanh_vien');
        const add_work = document.querySelector('#add_work');
        const them_cong_viec = document.querySelector('#them_cong_viec');
        if (e.target === projects){
            projects.style.backgroundColor = '#4c9beb';
            project_content.style.display = 'block';
            members.style.backgroundColor = 'white';
            discuss.style.backgroundColor = 'white';
            add_project.style.backgroundColor = 'white';
            div_add_project.style.display = 'none';
            remove_project.style.backgroundColor = 'white';
            update_and_remove.style.display = 'none';
            cac_tin_nhan.style.display = 'none';
            cac_thanh_vien.style.display = 'none';
            add_work.style.backgroundColor = 'white';
            them_cong_viec.style.display = 'none';
        }
        else if (e.target === members){
            projects.style.backgroundColor = 'white';
            project_content.style.display = 'none';
            members.style.backgroundColor = '#4c9beb';
            discuss.style.backgroundColor = 'white';
            add_project.style.backgroundColor = 'white';
            div_add_project.style.display = 'none';
            remove_project.style.backgroundColor = 'white';
            update_and_remove.style.display = 'none';
            cac_tin_nhan.style.display = 'none';
            cac_thanh_vien.style.display = 'block';
            add_work.style.backgroundColor = 'white';
            them_cong_viec.style.display = 'none';
        }
        else if(e.target === discuss){
            projects.style.backgroundColor = 'white';
            project_content.style.display = 'none';
            members.style.backgroundColor = 'white';
            discuss.style.backgroundColor = '#4c9beb';
            add_project.style.backgroundColor = 'white';
            div_add_project.style.display = 'none';
            remove_project.style.backgroundColor = 'white';
            update_and_remove.style.display = 'none';
            cac_thanh_vien.style.display = 'none';
            cac_tin_nhan.style.display = 'block';
            add_work.style.backgroundColor = 'white';
            them_cong_viec.style.display = 'none';
        }
        else if(e.target === add_project){
            projects.style.backgroundColor = 'white';
            project_content.style.display = 'none';
            members.style.backgroundColor = 'white';
            discuss.style.backgroundColor = 'white';
            add_project.style.backgroundColor = '#4c9beb';
            div_add_project.style.display = 'block';
            remove_project.style.backgroundColor = 'white';
            update_and_remove.style.display = 'none';
            cac_tin_nhan.style.display = 'none';
            cac_thanh_vien.style.display = 'none';
            add_work.style.backgroundColor = 'white';
            them_cong_viec.style.display = 'none';
        }
        else if(e.target === remove_project){
            projects.style.backgroundColor = 'white';
            project_content.style.display = 'none';
            members.style.backgroundColor = 'white';
            discuss.style.backgroundColor = 'white';
            add_project.style.backgroundColor = 'white';
            remove_project.style.backgroundColor = '#4c9beb';
            div_add_project.style.display = 'none';
            update_and_remove.style.display = 'block';
            cac_tin_nhan.style.display = 'none';
            cac_thanh_vien.style.display = 'none';
            add_work.style.backgroundColor = 'white';
            them_cong_viec.style.display = 'none';
        }
        else if(e.target === add_work){
            projects.style.backgroundColor = 'white';
            project_content.style.display = 'none';
            members.style.backgroundColor = 'white';
            discuss.style.backgroundColor = 'white';
            add_project.style.backgroundColor = 'white';
            remove_project.style.backgroundColor = 'white';
            div_add_project.style.display = 'none';
            update_and_remove.style.display = 'none';
            cac_tin_nhan.style.display = 'none';
            cac_thanh_vien.style.display = 'none';
            add_work.style.backgroundColor = '#4c9beb';
            them_cong_viec.style.display = 'block';
        }

        //hiển thị qua lại các trạng thái dự án
        const is_comming = document.querySelector('#is_comming');
        const to_do = document.querySelector('#to_do');
        const completed = document.querySelector('#completed');
        const project_is_comming = document.querySelectorAll('#project_is_comming');
        const project_to_do = document.querySelectorAll('#project_to_do');
        const project_completed = document.querySelectorAll('#project_completed');

        if (e.target == is_comming) {
            is_comming.style.borderBottom = '5px solid grey';
            to_do.style.borderBottom = 'none';
            completed.style.borderBottom = 'none';
            Array.from(project_is_comming).forEach(function(e) {
                e.style.display = 'block';
            });
            Array.from(project_to_do).forEach(function(e) {
                e.style.display = 'none';
            });
            Array.from(project_completed).forEach(function(e) {
                e.style.display = 'none';
            });
        } else if (e.target == to_do) {
            to_do.style.borderBottom = '5px solid grey';
            is_comming.style.borderBottom = 'none';
            completed.style.borderBottom = 'none';
            Array.from(project_is_comming).forEach(function(e) {
                e.style.display = 'none';
            });
            Array.from(project_to_do).forEach(function(e) {
                e.style.display = 'block';
            });
            Array.from(project_completed).forEach(function(e) {
                e.style.display = 'none';
            });
        } else if (e.target == completed) {
            completed.style.borderBottom = '5px solid grey';
            to_do.style.borderBottom = 'none';
            is_comming.style.borderBottom = 'none';
            Array.from(project_is_comming).forEach(function(e) {
                e.style.display = 'none';
            });
            Array.from(project_to_do).forEach(function(e) {
                e.style.display = 'none';
            });
            Array.from(project_completed).forEach(function(e) {
                e.style.display = 'block';
            });
        }

        //hiển thị chi tiết dự án
        const project_names = document.querySelectorAll('#project_name');
        const project_detail = document.querySelector('#project_detail');
        

        project_names.forEach(function(project_name) {
            if (project_name.contains(e.target)) {
                const id_du_an = project_name.querySelector('#id_du_an').textContent;
                project_content.style.display = 'none';
                fetch(`lay_chi_tiet_du_an.php?id_du_an=${ id_du_an }`)
                    .then(response=>response.text())
                    .then(response=>project_detail.innerHTML = response)
            }
        });
        if ((e.target == projects)||(e.target == members)||(e.target == discuss)||(e.target == add_project)||(e.target == remove_project)){
            project_detail.innerHTML = ''
        }

        //search
        const search = document.querySelector('#search');
        const ten_du_an = document.querySelector('#ten_du_an').value;
        if(e.target == search){
            fetch(`lay_chi_tiet_du_an2.php?ten_du_an=${ ten_du_an }`)
                .then(response=>response.text())
                .then(response=>project_detail.innerHTML = response);
            projects.style.backgroundColor = '#4c9beb';
            project_content.style.display = 'none';
            cac_tin_nhan.style.display = 'none';
            chi_tiet_tin_nhan.style.display = 'none';
            members.style.backgroundColor = 'white';
            discuss.style.backgroundColor = 'white';
            add_project.style.backgroundColor = 'white';
            div_add_project.style.display = 'none';
            remove_project.style.backgroundColor = 'white';
            update_and_remove.style.display = 'none';
        }

        //thêm dự án
        const button_add_project = document.querySelector('#button_add_project');
        if(e.target == button_add_project){
            const ten_du_an_them = document.querySelector('#ten_du_an_them').value;
            const start_day = document.querySelector('#start_day').value;
            const end_day = document.querySelector('#end_day').value;
            fetch(`add_project.php?ten_du_an=${ten_du_an_them}&start_day=${start_day}&end_day=${end_day}`)
            .then(response => response.text())
            .then(response => alert(response));
        }
    });



    
    //form thêm dự án
    document.addEventListener("DOMContentLoaded", function(){
        const start_day = document.querySelector('#start_day');
        const end_day = document.querySelector('#end_day');
        const tb_end_day = document.querySelector('#tb_end_day');
        const ten_du_an_them = document.querySelector('#ten_du_an_them');
        const tb_ten_du_an = document.querySelector('#tb_ten_du_an');
        const button_add_project = document.querySelector('#button_add_project');
        button_add_project.disabled = true

        end_day.onchange = function(){
            const start_date = new Date(start_day.value);
            const end_date = new Date(end_day.value);

            if (end_date < start_date){
                tb_end_day.innerHTML = '*ngày kết thúc không thể sớm hơn ngày bắt đầu, vui lòng nhập lại!';
            }
            else{
                tb_end_day.innerHTML = '';
            }
            if((ten_du_an_them.value.length > 1) && (end_date >= start_date)){
                button_add_project.disabled = false
            }
        }

        ten_du_an_them.onblur = function(){
            if(ten_du_an_them.value.length < 1){
                tb_ten_du_an.innerHTML = '*vui lòng nhập tên dự án';
            }
            else{
                tb_ten_du_an.innerHTML = '';
            }
        }

        //hiển thị xác nhận xóa
        const button_remove = document.querySelectorAll('.button_remove');
        const confirm_delete = document.querySelector('#confirm_delete');
        let id_du_an_delete
        button_remove.forEach(button => {
            button.addEventListener('click', function() {
                let row = this.closest('#pi');
                id_du_an_delete = row.querySelector('#id_du_an_delete').textContent
                confirm_delete.style.display = 'block';
            });
            //xác nhận xóa
            confirm_delete.addEventListener('click', function(e) {
                if (e.target.id === 'confirm_button') {
                    fetch(`delete_project.php?id_du_an=${id_du_an_delete}`)
                    confirm_delete.style.display = 'none';
                    location.reload();

                } else if (e.target.id === 'cancel_button') {
                    confirm_delete.style.display = 'none';
                }
            });
        });
    });








    //hải

    document.addEventListener('click', function(e){
        const projects = document.querySelector('#projects');
        const members = document.querySelector('#members');
        const discuss = document.querySelector('#discuss');
        const ten_nv = document.querySelectorAll('#ten');
        const thong_tin = document.querySelector('#thong_tin');
        const cac_thanh_vien = document.querySelector('#cac_thanh_vien');
        function lay_thong_tin_nhan_vien(ten) {
            fetch(`lay_thong_tin_nhan_vien.php?ten=${ ten }`).then(response=>response.text()).
            then(response=>thong_tin.innerHTML = response)
        }
        
        ten_nv.forEach(function(ten) {
            if (ten.contains(e.target)) {
                const tenz = ten.textContent;
                cac_thanh_vien.style.display = 'none';
                lay_thong_tin_nhan_vien(tenz);
            }
        });
        if ((e.target == projects)||(e.target == members)||(e.target == discuss)){
            thong_tin.innerHTML = ''
        }

        // gửi tin nhắn
        const gui_tin_nhan = document.querySelector('#gui_tin_nhan');
        function gui_di_tin_nhan(id_du_an, ten_dang_nhap,noi_dung) {
            fetch(`gui_di_tin_nhan.php?id_du_an=${id_du_an}&ten_dang_nhap=${ten_dang_nhap}&noi_dung=${noi_dung}`)
        }
        if(e.target == gui_tin_nhan){
            const tin_nhan = document.querySelector('#tin_nhan_gui').value;
            const noi_dung_tin_nhan = document.querySelector('#noi_dung_tin_nhan')
            const id_du_an = document.querySelector('#idda').value;
            const ten_dang_nhap = document.querySelector('#tdn').value;
            if(tin_nhan.length != 0){
                const p = document.createElement('p')
                p.innerHTML = tin_nhan;
                p.className = 'ban-than';
                noi_dung_tin_nhan.append(p);
                gui_di_tin_nhan(id_du_an, ten_dang_nhap, noi_dung)
                tin_nhan = '';
            }       
            e.preventDefault();
        }

        // hiện tin nhắn
        const tin_nhans = document.querySelectorAll('#tin_nhan');
        const chi_tiet_tin_nhan = document.querySelector('#chi_tiet_tin_nhan');
        function lay_chi_tiet_tin_nhan(id_du_an, ten_dang_nhap) {
            fetch(`lay_chi_tiet_tin_nhan.php?id_du_an=${ id_du_an }&ten_dang_nhap=${ ten_dang_nhap }`).then(response=>response.text()).
            then(response=>chi_tiet_tin_nhan.innerHTML = response)
        }

        
        tin_nhans.forEach(function(tin_nhan) {
            if (tin_nhan.contains(e.target)) {
                const cac_tin_nhan = document.querySelector('#cac_tin_nhan');
                const id_du_an = tin_nhan.querySelector('#id_da').textContent;
                const ten_dang_nhap = tin_nhan.querySelector('#nguoi_gui').textContent;
                cac_tin_nhan.style.display = 'none';
                lay_chi_tiet_tin_nhan(id_du_an, ten_dang_nhap);
            }
        });
        if ((e.target == projects)||(e.target == members)||(e.target == discuss)){
            chi_tiet_tin_nhan.innerHTML = ''
        }
    })








    //Minh
    document.addEventListener('click', function(e){
        const them_cv = document.querySelector('#them_cv');
        const form_them_cv = document.querySelector('#form_them_cv');
        const thong_tin_cong_viec = document.querySelector('#thong_tin_cong_viec');
        const tt = "<input type='text' class='noi_dung_cong_viec' placeholder='nội dung công việc'> Loại công việc: <select class='phan_loai'><option value='1'>lên kế hoạch</option><option value='2'>sửa chữa</option><option value='3'>đánh giá</option><option value='4'>phát triển</option></select> ngày bắt đầu: <input type='date' class='start' placeholder='ngày bắt đầu'> ngày kết thúc: <input type='date' class='end' placeholder='ngày kết thúc'><br>"
        if(e.target == them_cv){
            const div = document.createElement('div')
            div.innerHTML = tt;
            div.className = 'thong_tin_cong_viec mb-3';
            form_them_cv.append(div);
        }
    })

    document.addEventListener('click', function(e){
        const save_work = document.querySelector('#save_work');
        const add_work = document.querySelector('#add_work');

        function them_cong_viec(id_du_an, noi_dung, phan_loai, ngay_bat_dau, ngay_ket_thuc){
            const noi_dung_value = noi_dung.value;
            const phan_loai_value = phan_loai.value;
            const ngay_bat_dau_value = ngay_bat_dau.value;
            const ngay_ket_thuc_value = ngay_ket_thuc.value;
            fetch(`them_cong_viec.php?id_du_an=${id_du_an}&noi_dung=${noi_dung_value}&phan_loai=${phan_loai_value}&ngay_bat_dau=${ngay_bat_dau_value}&ngay_ket_thuc=${ngay_ket_thuc_value}`)
        }

        if(e.target == save_work){
            const id_du_an_select = document.querySelector('#id_du_an_select').value;
            const noi_dung_cong_viec = document.querySelectorAll('.noi_dung_cong_viec');
            const phan_loai = document.querySelectorAll('.phan_loai');
            const start = document.querySelectorAll('.start');
            const end = document.querySelectorAll('.end');
            for (let i = 0; i < noi_dung_cong_viec.length; i++) {
                them_cong_viec(id_du_an_select,noi_dung_cong_viec[i], phan_loai[i], start[i], end[i])
            }
            alert('thêm thành công!')
            location.reload();
        }
    })


    </script>
</body>
</html>